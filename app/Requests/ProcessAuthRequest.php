<?php

namespace App\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProcessAuthRequest extends AuthRequest
{
    public array $payment;
    public array $instrument;

    public function __construct(array $data)
    {
        $this->payment = $data['payment'];
        $this->instrument = $data['instrument'];
    }
    public static function url(?string $url): string
    {
        return $url . 'gateway/process';
    }

    public function toArray($login, $secretKey)
    {
        return array_merge(parent::auth($login,$secretKey), [
            'locale' => 'es_CO',
            'payment' => $this->payment,
            'instrument' => $this->instrument,
            'ipAddress' => app(Request::class)->getClientIp(),
            'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ]);
    }
}
