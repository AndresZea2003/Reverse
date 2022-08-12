<?php

namespace App\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionAuthRequest extends AuthRequest
{
    public array $payment;
    public array $instrument;
    public int $internalReference;
    public string $authorization;
    public string $action;

    public function __construct(array $data)
    {
        $this->internalReference = $data['internalReference'];
        $this->authorization = $data['authorization'];
        $this->action = $data['action'];
    }
    public static function url(?string $url): string
    {
        return $url . 'gateway/transaction';
    }

    public function toArray($login, $secretKey)
    {
        return array_merge(parent::auth($login, $secretKey), [
            'locale' => 'es_CO',
            'internalReference' => $this->internalReference,
            'authorization' => $this->authorization,
            'action' => $this->action,
        ]);
    }
}
