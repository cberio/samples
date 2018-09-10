<?php

namespace App\Http\Controllers\QuickBlox;

use App\Facades\QuickBlox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QuickBlox::retrieveMessages([
            'login'          => $request->user_name,
            'chat_dialog_id' => $request->dialog_id,
        ]);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = QuickBlox::sendMessage([
            'login'          => $request->user_name,
            'chat_dialog_id' => $request->dialog_id,
            'message'        => $request->message,
            'name'           => $request->user_name, // custom field (key-value paired)
            'custom_field'   => 'custom_value', // custom field (key-value paired)
            'any_field'      => 'any_field', // custom field (key-value paired)
        ]);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
