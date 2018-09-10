<?php

namespace App\Http\Controllers\QuickBlox;

use App\Facades\QuickBlox;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DialogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QuickBlox::retrieveRooms();

        return view('quickBlox.dialogs.index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = QuickBlox::createRoom([
            'user_id'   => $request->user_id,
            'occupants' => $request->occupants,
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
        $data = QuickBlox::updateRoom([
            'dialog_id'    => $id,
            'occupant_ids' => $request->occupant_ids,
        ]);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
