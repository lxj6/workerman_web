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
            'type'      => 'init',
            'client_id' => $client_id,
        ];
        //var_dump($res);
        Gateway::sendToClient($client_id, json_encode($res));
    }

    public static function onWebSocketConnect($client_id, $data)
    {
        //echo "onWebSocketConnect\r\n";
    }

    public static function onMessage($client_id, $data)
    {
        $message_data = json_decode($data);
        if (!$message_data) {
            return;
        }

        // 根据类型执行不同的业务
        switch ($message_data->type) {
            case 'init' :
                break;
            case 'ping' :
                return;
            case 'login' :
                return;
            case 'say' :
                    $resData = [
                        'type' => 'say',
                        'time' => time(),
                        'client_id' => $client_id,
                        'name' => $message_data->name,
                        'contentText' => $message_data->contentText,
                    ];
                    Gateway::sendToAll(json_encode($resData));
                break;
            default :
                break;
        }
    }

    public static function onClose($client_id)
    {
        echo "onClose\r\n";
    }


}
