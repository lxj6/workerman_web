<?php

namespace App\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

abstract class ApiCaller extends DBModel implements AuthenticatableContract
{
    use Authenticatable;

    const Api_Exp_Minutes = 60 * 24;
    const Api_Caller_Type = 'default';

    public function getCallerType()
    {
        return static::Api_Caller_Type;
    }

    public function getCallerId()
    {
        return $this->getAuthIdentifier();
    }

    public function getTokenPayload()
    {
        $data = [
            'type' => $this->getCallerType(),
            'user_id' => $this->getCallerId(),
            'exp' => time() + (static::Api_Exp_Minutes * 60),
        ];
        return $data;
    }

    public function getApiToken()
    {
        $payload = $this->getTokenPayload();
        $strJson = json_encode($payload, JSON_UNESCAPED_UNICODE);

        $base64 = base64_encode($strJson);
        $secret = env('API_SECRET');
        $sign = hash('sha256',$base64.$secret);

        return $base64.'.'.$sign;
    }




}
