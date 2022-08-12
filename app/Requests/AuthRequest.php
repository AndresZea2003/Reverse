<?php

namespace App\Requests;

use App\Contracts\WebcheckoutRequestContract;
use Illuminate\Support\Str;

class AuthRequest
{
    public function auth($login, $secretKey)
    {
        $seed = date('c');
        $nonce = Str::random(8);
        $tranKey = base64_encode(hash('sha256', $nonce.$seed.$secretKey, true));

        return [
            'auth' => [
                'login' => $login,
                'tranKey' => $tranKey,
                'nonce' => base64_encode($nonce),
                'seed' => $seed
            ]
        ];
    }
}
