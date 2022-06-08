<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class UserServices extends BaseServers
{

    public function login($input)
    {



        User::login();
        /*$user = User::where('user_name',$input['user_name'])->first();

        if (!$user) {
            return response()->error(500,'');
        }

        if (!password_verify($input['password'],$user->password)) {
            return response()->error(500,'密码不正确!');
        }

        Auth::login($user);*/

    }



}
