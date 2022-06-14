<?php

namespace App\Http\Controllers;

use App\Models\FirendRequestRecord;
use App\Services\FirendsServers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function applyList()
    {
        $user = Auth::user();

        $list = FirendRequestRecord::with(['form_id','to_id'])->get()->toArray();

        dd($list);
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
