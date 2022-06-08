<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const check_rule = [
        'user_name' => 'required|max:20',
        'password'  => 'required|max:16',
    ];

    public function register(Request $request)
    {
        $request->validate(self::check_rule);

        User::create($request->user_name,$request->password);

        return response()->success();
    }


    public function login(Request $request)
    {
        $request->validate(self::check_rule);

        UserServices::getServices()->login($request->post());

        return response()->success();
    }


}
