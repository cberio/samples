<?php

namespace App\Http\Controllers\AppLozic;

use App\AppLozicUser;
use App\Facades\AppLozic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = AppLozicUser::all();

        return view('appLozic.index', ['users' => $users]);
    }

    public function create()
    {
        $faker = \Faker\Factory::create();

        return view('appLozic.create', ['faker'=> $faker]);
    }

    public function store(Request $request)
    {
        $user   = AppLozicUser::make([
            'id'            => (string) Str::uuid(),
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => $request->password,
            'device_type'   => $request->device_type,
            'contactNumber' => $request->contact_number,
        ]);

        $result = AppLozic::createUser([
            'applicationId' => env('APP_LOZIC_ID'),
            'userId'        => $user->id,
            'displayName'   => $request->name,
            'email'         => $request->email,
            'password'      => $request->password,
            'deviceType'    => $request->device_type,
            // 'authenticationType' => $user->authentication_type,
            // 'registrationId' => $user->registration_id, // Device GCM or APN id
            // 'pushNotificationFormat' => $user->push_notification_format,
            'contactNumber' => $request->contact_number,
        ]);

        if ($result) {
            $user->key = $result->userKey;
            $user->save();
        }

        return redirect()->route('appLozic.index');
    }

    public function edit(AppLozicUser $user)
    {
        $details = AppLozic::getUserDetails([
            'userIdList' => [(string)$user->id],
        ]);

        $rooms = AppLozic::getParticipatingRooms([
            'id' => [(string)$user->id],
        ]);

        if ($details) {
            $details = filled($details->response) ? $details->response[0] : null;
        }

        return view('appLozic.edit', [
            'user'     => $user,
            'details'  => $details,
            'rooms'    => $rooms,
        ]);
    }

    public function update(Request $request)
    {
        AppLozic::setUserDetail([
            'id'            => $request->id,
            'email'         => $request->email,
            'displayName'   => $request->display_name,
            'imageLink'     => $request->image_link,
            'statusMessage' => $request->status_message,
        ]);

        return redirect()->route('appLozic.edit', $request->id);
    }
}
