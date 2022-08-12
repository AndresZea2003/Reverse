<?php

namespace App\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QueryAuthRequest extends AuthRequest
{
    public int $internalReference;

    public function __construct(array $data)
    {
        $this->internalReference = $data['internalReference'];
    }
    public static function url(?string $url): string
    {
        return $url . 'gateway/query';
    }

    public function toArray($login, $secretKey)
    {
        return array_merge(parent::auth($login, $secretKey), [
            'locale' => 'es_CO',
            'internalReference' => $this->internalReference
        ]);
    }
}
