<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success',function ($code = 0, $msg = 'success') {
            return Response::json_unicode(['code' => $code, 'msg' => $msg]);
        });

        Response::macro('error', function ($code = -1, $msg = 'error') {
            return Response::json_unicode(['code' => $code, 'msg' => $msg]);
        });

        Response::macro('array', function ($data, $code = 0, $msg = 'success') {
            return Response::json_unicode(['code' => $code, ' msg' => $msg, 'data' => $data]);
        });


        Response::macro('json_unicode',function ($arr) {
            return response()->json($arr)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        });


    }
}
