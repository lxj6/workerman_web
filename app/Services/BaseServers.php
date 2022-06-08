<?php

namespace App\Services;

class BaseServers
{
    protected static $instance = [];


    public static function getServices()
    {
        if ( (static::$instance[static::class] ?? null) instanceof static) {
            return static::$instatnce[static::class];
        }
        return static::$instance[static::class] = new static();
    }

    private function __construct()
    {

    }

    private function __clone()
    {

    }
}
