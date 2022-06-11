<?php


if (!function_exists('test')) {
    function test()
    {
        echo \Carbon\Carbon::now()->timestamp;
    }
}
