<?php

class AuthMiddleware
{
    public static function check()
    {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            Response::json([
                'success' => false,
                'message' => 'Thiếu token'
            ], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $payload = JwtService::verifyToken($token);

        if (!$payload) {
            Response::json([
                'success' => false,
                'message' => 'Token không hợp lệ hoặc hết hạn'
            ], 401);
        }

        return $payload;
    }
}
