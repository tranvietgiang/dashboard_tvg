<?php

class CsrfMiddleware
{
    private const SESSION_KEY = '_csrf_token';
    private const HEADER_KEY = 'X-CSRF-TOKEN';

    public static function token()
    {
        self::startSession();

        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::SESSION_KEY];
    }

    public static function input()
    {
        return '<input type="hidden" name="_csrf_token" value="' . Security::e(self::token()) . '">';
    }

    public static function check()
    {
        self::startSession();

        $token = $_POST['_csrf_token'] ?? self::headerToken();
        $sessionToken = $_SESSION[self::SESSION_KEY] ?? '';

        if (!$token || !$sessionToken || !hash_equals($sessionToken, $token)) {
            Response::json([
                'success' => false,
                'message' => 'CSRF token không hợp lệ'
            ], 419);
        }

        return true;
    }

    private static function headerToken()
    {
        $headers = function_exists('getallheaders') ? getallheaders() : [];

        return $headers[self::HEADER_KEY]
            ?? $headers[strtolower(self::HEADER_KEY)]
            ?? $_SERVER['HTTP_X_CSRF_TOKEN']
            ?? '';
    }

    private static function startSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
