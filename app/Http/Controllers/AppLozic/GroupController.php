<?php

namespace App\Http\Controllers\AppLozic;

use App\Facades\AppLozic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $rooms = AppLozic::createRoom([
            'group_name' => $request->room_name,
            'id'         => $request->target_user_id
        ]);

        return response()->json($rooms);
    }

    public function removeUser(Request $request)
    {
        $result = AppLozic::removeUserFromRoom([
            'group_id' => [$request->group_id],
            'user_id'  => [$request->user_id],
        ]);

        return response()->json($result);
    }
}
