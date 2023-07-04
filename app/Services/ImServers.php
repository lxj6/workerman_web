<?php

namespace App\Services;

use App\Models\UserChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImServers extends BaseServers
{
    public function send($input)
    {
        $user = Auth::user();
        $time = time();
        switch ($input['type']) {
            case 'firend' :

                // 发送
                $chat_id = DB::table('user_chat')->select('id')->where('user_id', $user->id)->where('to_id', $input['to_id'])->first();
                if (!$chat_id) {
                    $chat_id = DB::table('user_chat')->insertGetId(['user_id' => $user->id, 'to_id' => $input['to_id'], 'msg_type' => $input['msg_type'], 'last_msg' => $input['content'], 'created_at' => $time, 'updated_at' => $time]);
                } else {
                    $chat_id = $chat_id->id;
                    DB::table('user_chat')->where('id', $chat_id)->update(['user_id' => $user->id, 'to_id' => $input['to_id'], 'msg_type' => $input['msg_type'], 'last_msg' => $input['content'], 'updated_at' => $time]);
                }
                UserChatMessage::createMessage($chat_id, $user->id, $input['to_id'], $input['content'], $input['msg_type']);

                // 接收 reverse
                $chat_id = DB::table('user_chat')->select('id')->where('user_id', $input['to_id'])->where('to_id', $user->id)->first();
                if (!$chat_id) {
                    $chat_id = DB::table('user_chat')->insertGetId(['user_id' => $input['to_id'], 'to_id' => $user->id, 'msg_type' => $input['msg_type'], 'last_msg' => $input['content'], 'created_at' => $time, 'updated_at' => $time]);
                } else {
                    $chat_id = $chat_id->id;
                    DB::table('user_chat')->where('id',$chat_id)->update(['user_id' => $input['to_id'], 'to_id' => $user->id, 'msg_type' => $input['msg_type'], 'last_msg' => $input['content'], 'updated_at' => $time]);
                }

                UserChatMessage::createMessage($chat_id, $input['to_id'], $user->id, $input['content'], $input['msg_type'], 0);

                break;
            case 'group' :
                break;
            default:
        }
    }
}
