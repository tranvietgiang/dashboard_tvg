<?php

class Security
{
    public static function e($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    public static function cleanString($value)
    {
        return trim((string) $value);
    }

    public static function cleanEmail($value)
    {
        return filter_var(self::cleanString($value), FILTER_SANITIZE_EMAIL);
    }

    public static function isValidEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function jsonInput()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        return is_array($input) ? $input : [];
    }

    public static function requestInput()
    {
        return array_merge($_POST, self::jsonInput());
    }

    public static function sendSecurityHeaders()
    {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.tailwindcss.com; style-src 'self' 'unsafe-inline'; img-src 'self' data:; base-uri 'self'; form-action 'self'");
    }
}
