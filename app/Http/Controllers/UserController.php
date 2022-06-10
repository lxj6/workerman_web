<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const Check_Rule = [
        'user_name' => 'required|max:20',
        'password'  => 'required|max:16',
    ];

    public function register(Request $request)
    {
        $request->validate(self::Check_Rule);

        User::create($request->user_name,$request->password);

        return response()->success();
    }


    public function login(Request $request)
    {
        $request->validate(self::Check_Rule);

        UserServices::getServices()->login($request->post());

        return response()->success();
    }

    public function info()
    {
        $arr = Auth::user();

        return response()->array($arr);
    }


    public function query(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
        ]);

        $usre = User::where('user_name',$request->post('user_name'))->first();

        return response()->array($usre);
    }


}
