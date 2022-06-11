<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function uploadImg(Request $request)
    {
        $request->validate([
            'img' => 'required|image',
        ]);
        test();
    }


}
