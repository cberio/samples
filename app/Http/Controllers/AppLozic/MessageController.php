<?php

namespace App\Http\Controllers\AppLozic;

use App\Facades\AppLozic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = AppLozic::retrieveMessages([
            'id'       => $request->id,
            'group_id' => $request->group_id,
        ]);

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $data = AppLozic::sendMessage([
            'id'             => $request->id,
            'group_id'       => $request->group_id,
            'message'        => $request->message,
            'target_user_id' => $request->target_user_id,
        ]);

        return response()->json($data);
    }
}
