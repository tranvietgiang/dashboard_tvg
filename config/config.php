<?php

function loadEnv($path)
{
    if (!is_file($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $key = preg_replace('/^\xEF\xBB\xBF/', '', $key);
        $value = trim($value);
        $value = trim($value, "\"'");

        if ($key !== '' && getenv($key) === false && !array_key_exists($key, $_ENV)) {
            if (function_exists('putenv')) {
                putenv($key . '=' . $value);
            }

            $_ENV[$key] = $value;
        }
    }
}

function envValue($key, $default = null)
{
    $value = getenv($key);

    if ($value !== false) {
        return $value;
    }

    return array_key_exists($key, $_ENV) ? $_ENV[$key] : $default;
}

loadEnv(__DIR__ . '/../.env');

define('DB_HOST', envValue('DB_HOST', 'localhost'));
define('DB_NAME', envValue('DB_NAME', 'dashboard'));
define('DB_USER', envValue('DB_USER', 'root'));
define('DB_PASS', envValue('DB_PASS', ''));

define('APP_URL', rtrim(envValue('APP_URL', ''), '/'));
define('API_BASE_URL', envValue('API_BASE_URL', '/api'));
define('API_ROUTE_PREFIX', parse_url(API_BASE_URL, PHP_URL_PATH) ?: API_BASE_URL);

define('JWT_SECRET', envValue('JWT_SECRET', 'change_me'));
define('JWT_EXPIRE', (int) envValue('JWT_EXPIRE', 3600));

define('INFINITYFREE_USERNAME', envValue('INFINITYFREE_USERNAME', ''));

function buildUrl($baseUrl, $path = '')
{
    $baseUrl = rtrim((string) $baseUrl, '/');
    $path = '/' . ltrim((string) $path, '/');

    if ($path === '/') {
        return $baseUrl === '' ? '/' : $baseUrl;
    }

    return $baseUrl . $path;
}

function appUrl($path = '')
{
    return buildUrl(APP_URL, $path);
}

function apiUrl($path = '')
{
    return buildUrl(API_BASE_URL, $path);
}

function apiRoute($path = '')
{
    return buildUrl(API_ROUTE_PREFIX, $path);
}
