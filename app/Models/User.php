<?php

namespace App\Models;


class User extends ApiCaller
{
    protected $table = 'user';

    protected $hidden = ['chat_id','password','phone','updated_at'];

    const Api_Caller_Type = 'user';


    public static function create($user_name, $password)
    {
        $user = new User();
        $user->user_name = $user_name;
        $user->password = password_hash($password,PASSWORD_BCRYPT);
        $user->save();
    }



}
