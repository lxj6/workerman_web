<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function upload(Request $request)
    {
        $request->validate([
            'img' => 'required|image',
        ]);

        $url = upload_img($request->file('img'));

        return response()->string($url);
    }


}
