<?php

namespace App\Http\Controllers\QuickBlox;

use App\Facades\QuickBlox;
use App\Http\Controllers\Controller;
use App\QuickBloxUser;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = QuickBlox::retrieveUsers([
            'page'     => $request->page,
            'per_page' => $request->per_page,
        ]);

        $data = $this->generatePagination($users)->withPath('/quickBlox');

        return view('quickBlox.index', ['users' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faker = \Faker\Factory::create();

        return view('quickBlox.create', ['faker' => $faker]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = QuickBloxUser::create([
            'name'      => $request->user_name,
            'email'     => $request->email,
            'full_name' => $request->full_name,
            'password'  => $request->password,
            'phone'     => $request->phone,
            'custom'    => $request->custom_data,
            'tags'      => $request->tags
        ]);

        $result = QuickBlox::createUser([
            'login'            => $request->user_name,
            'password'         => $request->password,
            'full_name'        => $request->full_name,
            'external_user_id' => $user->id,
            'phone'            => $request->phone,
            'custom_data'      => $request->custom_data,
            'tag_list'         => implode(', ', $request->tags),
        ]);

        $user->chat_id = $result->user->id;
        $user->save();

        return redirect()->route('quickBlox.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data    = QuickBlox::getUserDetails(['id' => $id]);
        $dialogs = QuickBlox::getParticipatingRooms([
            'login'    => $data->user->login,
            'password' => '00000000',
        ]);

        return view('quickBlox.edit', [
            'user'    => $data->user,
            'dialogs' => $dialogs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = QuickBloxUser::query()
            ->where('chat_id', $id)
            ->first();

        $custom = [
            'picture' => [
                [
                    'order' => 0,
                    'path'  => '/upload/img.jpg'
                ],
                [
                    'order' => 1,
                    'path'  => '/upload/img.jpg'
                ]
            ]
        ];

        if ($user) {
            $user->update([
                'name'      => $request->user_name,
                'email'     => $request->email,
                'full_name' => $request->full_name,
                'phone'     => $request->phone,
                'custom'    => $custom,
                'tags'      => $request->tags
            ]);
        }

        QuickBlox::setUserDetails([
            'id'               => $id,
            'login'            => $request->login,
            'login_changed'    => $request->user_name,
            'full_name'        => $request->full_name,
            'external_user_id' => optional($user)->id,
            'phone'            => $request->phone,
            'custom_data'      => json_encode($custom),
            'tag_list'         => implode(', ', $request->tags),
        ]);

        return redirect()->route('quickBlox.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function generatePagination($data)
    {
        $items   = data_get($data, 'items', 0);
        $total   = data_get($data, 'total_entries', 0);
        $perPage = data_get($data, 'per_page', 15);
        $current = data_get($data, 'current_page', 1);

        $users   = collect($items)->map(function ($item) {
            return $item->user;
        });

        return new LengthAwarePaginator($users, $total, $perPage, $current);
    }
}
