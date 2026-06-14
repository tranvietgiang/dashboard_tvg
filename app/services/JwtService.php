<?php

class JwtService
{
    private static function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function base64UrlDecode($data)
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }

    public static function createToken($payload)
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];

        $payload['iat'] = time();
        $payload['exp'] = time() + JWT_EXPIRE;

        $headerEncoded = self::base64UrlEncode(json_encode($header));
        $payloadEncoded = self::base64UrlEncode(json_encode($payload));

        $signature = hash_hmac(
            'sha256',
            $headerEncoded . "." . $payloadEncoded,
            JWT_SECRET,
            true
        );

        $signatureEncoded = self::base64UrlEncode($signature);

        return $headerEncoded . "." . $payloadEncoded . "." . $signatureEncoded;
    }

    public static function verifyToken($token)
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            return false;
        }

        [$headerEncoded, $payloadEncoded, $signatureEncoded] = $parts;

        $signature = hash_hmac(
            'sha256',
            $headerEncoded . "." . $payloadEncoded,
            JWT_SECRET,
            true
        );

        $validSignature = self::base64UrlEncode($signature);

        if (!hash_equals($validSignature, $signatureEncoded)) {
            return false;
        }

        $payload = json_decode(self::base64UrlDecode($payloadEncoded), true);

        if (!$payload || $payload['exp'] < time()) {
            return false;
        }

        return $payload;
    }
}
