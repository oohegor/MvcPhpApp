<?php

declare(strict_types=1);

class CSRFService
{
    private function urlSafeEncode($m): string
    {
        return rtrim(strtr(base64_encode($m), '+/', '-_'), '=');
    }

    private function urlSafeDecode($m): false|string
    {
        return base64_decode(strtr($m, '-_', '+/'));
    }

    public function createToken(): string
    {
        $seed = $this->urlSafeEncode(random_bytes(8));
        $t = time();
        $hash = $this->urlSafeEncode(hash_hmac('sha256', session_id() . $seed . $t, ENV['CSRF_TOKEN_SECRET'], true));

        return $this->urlSafeEncode($hash . '|' . $seed . '|' . $t);
    }

    public function validateToken($token): bool
    {
        $parts = explode('|', $this->urlSafeDecode($token));
        if (count($parts) === 3) {
            $hash = hash_hmac('sha256', session_id() . $parts[1] . $parts[2], ENV['CSRF_TOKEN_SECRET'], true);
            if (hash_equals($hash, $this->urlSafeDecode($parts[0]))) {
                return true;
            }
        }

        return false;
    }
}
