<?php

namespace App\Http\Controllers;

use App\Services\ImServers;
use Illuminate\Http\Request;

class ImController extends Controller
{
    public function queryChatList(Request $request)
    {
        $data = ImServers::getServices()->queryChatList($request->post());

        return response()->array($data);
    }

    public function queryMsg(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|bail|integer',
        ]);

        $data = ImServers::getServices()->queryMsg($request->post());

        return response()->array($data);
    }

    public function send(Request $request)
    {
        $request->validate([
           'to_id'    => 'required|bail|integer',
           'content'  => 'required|bail|string',
           'type'     => 'required|bail|string',
           'msg_type' => 'required|bail|integer',
        ]);

        ImServers::getServices()->send($request->post());

        return response()->success();
    }
}
