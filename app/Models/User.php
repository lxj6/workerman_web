<?php

namespace App\Models;


class User extends ApiCaller
{
    protected $table = 'user';

    protected $hidden = ['chat_id','password','phone','updated_at'];

    const Api_Caller_Type = 'user';


    public static function create($user_name, $password, $nick_name, $autograph)
    {
        $user                = new User();
        $user->user_name     = $user_name;
        $user->nick_name     = $nick_name;
        $user->head_portrait = 'http://124.222.139.59:8001/icon/default_head.png';
        $user->password      = password_hash($password, PASSWORD_BCRYPT);
        $user->autograph     = !empty($autograph) ?: '这个人很懒,没有留下签名!';
        $user->save();
    }



}
