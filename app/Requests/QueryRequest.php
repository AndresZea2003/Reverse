<?php

namespace App\Requests;

use Illuminate\Http\Request;

class QueryRequest extends GetInformationRequest
{
    public int $internalReference;

    public function __construct(array $data)
    {
        $this->internalReference = $data['internalReference'];
    }
    public static function url(?int $session_id): string
    {
        return config('webcheckout.url') . 'gateway/query';
    }

    public function toArray()
    {
        return array_merge(parent::auth(), [
            'locale' => 'es_CO',
            'internalReference' => $this->internalReference
        ]);
    }
}
