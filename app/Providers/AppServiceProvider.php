<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\EventListener\ValidateRequestListener;

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
        Response::macro('success',function ($code = 0, $msg = 'success', $token = '') {
            return Response::json_unicode(['code' => $code, 'msg' => $msg, 'token' => $token]);
        });

        Response::macro('error', function ($code = -1, $msg = 'error', $token = '') {
            return Response::json_unicode(['code' => $code, 'msg' => $msg, 'token' => $token]);
        });

        Response::macro('array', function ($data, $code = 0, $msg = 'success', $token = '') {
            return Response::json_unicode(['code' => $code, ' msg' => $msg, 'data' => $data, 'token' => $token]);
        });


        Response::macro('json_unicode',function ($arr) {
            $api_caller = Auth::user();

            if (empty($arr['token'])) {
                if ($api_caller == null) {
                    Arr::pull($arr,'token');
                } else {
                    $arr['token'] = $api_caller->getApiToken();
                }
            }

            return response()->json($arr)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        });

    }
}
