<?php

class XssMiddleware
{
    public static function escape($value)
    {
        return Security::e($value);
    }

    public static function headers()
    {
        Security::sendSecurityHeaders();
    }
}
