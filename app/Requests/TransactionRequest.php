<?php

namespace App\Requests;

use Illuminate\Http\Request;

class TransactionRequest extends GetInformationRequest
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
    public static function url(?int $session_id): string
    {
        return config('webcheckout.url') . 'gateway/transaction';
    }

    public function toArray()
    {
        return array_merge(parent::auth(), [
            'locale' => 'es_CO',
            'internalReference' => $this->internalReference,
            'authorization' => $this->authorization,
            'action' => $this->action,
        ]);
    }
}
