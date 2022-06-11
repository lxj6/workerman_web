<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('test')) {
    function test()
    {
        echo \Carbon\Carbon::now()->timestamp;
    }
}


if (!function_exists('upload_img')) {
    function upload_img($file, $type = 1)
    {
        $path = 'uploads/';
        $ext = $file->getClientOriginalExtension();

        $dir = [
            1 => 'default'
        ];
        $name = date('YmdHis').mt_rand(1000,9999).'.'.$ext;

        $url = Storage::putFileAs($path.$dir[$type], $file, $name);

        return env('APP_URL').$url;
    }
}
