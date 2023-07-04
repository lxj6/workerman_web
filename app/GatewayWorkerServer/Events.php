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
        $message_data = json_decode($data);
        if (!$message_data) return ;
        $body = $message_data->body;

        // 根据类型执行不同的业务
        switch ($message_data->type) {
            case 'init' :
                Gateway::bindUid($client_id,$body->user_id);
                self::send($client_id);
                break;
            case 'message' :
                    //Gateway::sendToAll(json_encode($resData));
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

}
