<?php

namespace App\Models;


class User extends DBModel
{
    protected $table = 'user';

    public static function create($user_name, $password)
    {
        $user = new User();
        $user->user_name = $user_name;
        $user->password = password_hash($password,PASSWORD_BCRYPT);
        $user->save();
    }

}
