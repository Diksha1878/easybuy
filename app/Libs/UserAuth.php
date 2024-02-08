<?php

namespace App\Libs;

class UserAuth
{
    public static function has($action = false)
    {
        if (strtoupper($action) === 'LOGIN' && session('user')) {
            return true;
        }
        return false;
    }
}
