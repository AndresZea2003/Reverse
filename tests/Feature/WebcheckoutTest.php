<?php

namespace Tests\Feature;

use App\Requests\CreateSessionRequest;
use App\Requests\GetInformationRequest;
use App\Services\WebcheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebcheckoutTest extends TestCase
{
    public function testItCanGetInformationRequest()
    {
        $request = (new GetInformationRequest())->auth();
        $this->assertAuthSuccess($request);
    }

    public function testItCanGetCreateSessionRequest()
    {
        $request = (new CreateSessionRequest($this->getCreateSessionData()))->toArray();
        $this->assertAuthSuccess($request);

        $this->assertArrayHasKey('payment', $request);
        $this->assertArrayHasKey('expiration', $request);
        $this->assertArrayHasKey('locale', $request);
        $this->assertArrayHasKey('returnUrl', $request);
    }


    private function assertAuthSuccess(array $request): void
    {
        $this->assertArrayHasKey('auth', $request);
        $this->assertArrayHasKey('login', $request['auth']);
        $this->assertArrayHasKey('tranKey', $request['auth']);
        $this->assertArrayHasKey('nonce', $request['auth']);
        $this->assertArrayHasKey('seed', $request['auth']);
    }

    private function getCreateSessionData(): array
    {
        return [
            'payment' => [
                'reference' => 'TEST_1000',
                'description' => 'Conexion con WebCheckout desde un test',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '50000',
                ],
            ],
            'returnUrl' => 'https://www.youtube.com/',
            'expiration' => date('c', strtotime('+2 days')),
        ];
    }
}
