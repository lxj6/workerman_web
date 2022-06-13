<?php

namespace App\Http\Controllers;

use App\Services\FirendsServers;
use Illuminate\Http\Request;

class FirendsController extends Controller
{

    public function apply(Request $request)
    {
        $request->validate([
            'firend_id' => 'required|integer',
            'apply'     => 'apply',
        ]);

        FirendsServers::getServices()->add($request->post());

        return response()->success();
    }


}
