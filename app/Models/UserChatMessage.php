<?php

namespace App\Models;

class UserChatMessage extends DBModel
{
    protected $table = 'user_chat_message';

    protected $guarded = [];

    public static function createMessage($chat_id,$user_id,$to_id,$content,$msg_type,$is_read = 1)
    {
        $create = [
            'chat_id'  => $chat_id,
            'user_id'  => $user_id,
            'to_id'    => $to_id,
            'content'  => $content,
            'is_read'  => $is_read,
            'msg_type' => $msg_type,
        ];
        self::create($create);
    }


    public function user_id()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function to_id()
    {
        return $this->hasOne('App\Models\User','id','to_id');
    }

}
