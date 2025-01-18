<?php

namespace Vendor\LaravelRestToolkit\Helpers;

use Laravel\Sanctum\PersonalAccessToken;

class AuthHelper
{
    /**
     * دریافت توکن Bearer از هدر Authorization، جدا کردن آن و پیدا کردن کاربر.
     *
     * @param string $authorizationHeader
     * @return \App\Models\User|null
     */
    public static function getUserFromToken(string $authorizationHeader)
    {
        // بررسی فرمت صحیح هدر Authorization
        if (strpos($authorizationHeader, 'Bearer ') === false) {
            return null;
        }

        // جدا کردن توکن از هدر Authorization
        $token = str_replace('Bearer ', '', $authorizationHeader);

        // پیدا کردن توکن با استفاده از Laravel Sanctum
        $accessToken = PersonalAccessToken::where('token', hash('sha256', $token))->first();

        // اگر توکن پیدا نشد
        if (!$accessToken) {
            return null;
        }

        // دریافت کاربر از طریق توکن
        $user = $accessToken->tokenable;

        return $user;
    }
}
