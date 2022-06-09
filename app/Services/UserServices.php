<?php

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class UserServices extends BaseServers
{

    public function login($input)
    {

        $user = User::where('user_name',$input['user_name'])->first();

        if (!$user) {
            BusinessException::throw('用户不存在');
        }

        if (!password_verify($input['password'],$user->password)) {
            BusinessException::throw('密码不正确');
        }

        Auth::login($user);
    }



}
