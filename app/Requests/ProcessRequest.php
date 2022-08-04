<?php

namespace App\Requests;

use Illuminate\Http\Request;

class ProcessRequest extends GetInformationRequest
{
    public array $payment;
    public array $instrument;

    public function __construct(array $data)
    {
        $this->payment = $data['payment'];
        $this->instrument = $data['instrument'];
    }
    public static function url(?int $session_id): string
    {
        return config('webcheckout.url') . 'gateway/process';
    }

    public function toArray()
    {
        return array_merge(parent::auth(), [
            'locale' => 'es_CO',
            'payment' => $this->payment,
            'instrument' => $this->instrument,
            'ipAddress' => app(Request::class)->getClientIp(),
            'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ]);
    }
}
