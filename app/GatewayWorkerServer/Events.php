<?php
namespace App\GatewayWorkerServer;


use GatewayWorker\Lib\Gateway;

class Events
{

    public static function onWorkerStart($businessWorker)
    {
        echo "onWorkerStart".PHP_EOL;
    }

    public static function onConnect($client_id)
    {
        $res = [
            'type'    => 'init',
            'body' => [
                'client_id'     => $client_id,
                'ping_type'     => env('PING_NOT_RESPONSE_LIMIT'), // 心跳发送方 0-server发送 1-client发送
                'ping_interval' => env('PING_INTERVAL'), // 心跳发送间隔
            ],
        ];
        Gateway::sendToClient($client_id, json_encode($res));
    }

    public static function onWebSocketConnect($client_id, $data)
    {
        //echo "onWebSocketConnect\r\n";
    }

    public static function onMessage($client_id, $data)
    {
        //self::println("接收message",$data);
        $message_data = json_decode($data);
        if (!$message_data) return ;
        $body = $message_data->body;
        // 根据类型执行不同的业务
        switch ($message_data->type) {
            case 'init' :
                /**
                 * {
                "type": "init",
                "body": {
                "user_id": 1,
                "client_id": "7f00000107d000000001"
                }
                }
                 */
                //self::println("user init",$body);
                Gateway::bindUid($client_id,$body->user_id);
                self::send($client_id);
                break;
            case 'message' :
                /**
                 * {
                    "type":"message",
                    "body":{
                    "from":1,
                    "from_name":"lixiaojing",
                    "from_avatar":"1.jpg",
                    "to":2,
                    "to_name":"james",
                    "to_avatar":"2.jpg",
                    "content":"haha",
                    "msg_type":1,
                    }
                    }
                 */
                $online = Gateway::isUidOnline($body->to);
                //self::println("判断{$body->to}是否在线--{$online}");
                if ($online != 0) {
                    Gateway::sendToUid($body->to,$data);
                }
                self::send($client_id);
                break;
            case 'group' :
                break;
            default :
                break;
        }
    }

    public static function onClose($client_id)
    {
        echo "onClose:" . $client_id . "\r\n";
    }


    public static function send($client_id, $msg = 'success')
    {
        $data = [
            'type' => 'handleStatus',
            'body' => [
                'msg' => $msg,
            ]
        ];

        Gateway::sendToClient($client_id,json_encode($data));
    }


    public static function println($msg,$data)
    {
        if (is_array($data)) {
            $data = json_encode($msg,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        //echo $msg.$data."\r\n";
    }

}
