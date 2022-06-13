<?php

namespace App\Http\Controllers;

use App\Models\FirendRequestRecord;
use App\Services\FirendsServers;
use Illuminate\Http\Request;

class FirendsController extends Controller
{

    public function add(Request $request)
    {
        $request->validate([
            'firend_id' => 'required|integer',
            'apply'     => 'max:30',
        ]);

        FirendsServers::getServices()->add($request->post());

        return response()->success();
    }

    public function applyList(Request $request)
    {

    }

    public function agree(Request $request)
    {
        $request->validate([
            'record_id' => 'required|integer',
        ]);

        FirendsServers::getServices()->agree($request->record_id);

        return response()->success();
    }

    public function refuse(Request $request)
    {
        $request->validate([
            'record_id' => 'required|integer'
        ]);

        FirendRequestRecord::saveItemById($request->record_id, ['state' => -1]);

        return response()->success();
    }

}
