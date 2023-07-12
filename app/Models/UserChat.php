<?php
/**
 * Create by PhpStorm.
 * Auther 李晓景
 * Date: 2023/07/12
 * Time: 17:08
 **/
namespace App\Models;

class UserChat extends DBModel
{
    protected $table = 'user_chat';

    protected $guarded = [];

    public function user_id()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function to_id()
    {
        return $this->hasOne('App\Models\User','id','to_id');
    }

}
