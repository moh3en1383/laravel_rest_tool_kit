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
        if (strpos($authorizationHeader, 'Bearer ') === false) {
            return null;
        }

        $token = str_replace('Bearer ', '', $authorizationHeader);

        $accessToken = PersonalAccessToken::where('token', hash('sha256', $token))->first();

        if (!$accessToken) {
            return null;
        }

        $user = $accessToken->tokenable;

        return $user;
    }
}
