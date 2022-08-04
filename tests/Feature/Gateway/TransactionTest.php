<?php

namespace Tests\Feature\Gateway;

use App\Services\WebcheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function testItCanTransactionFromServiceCorrectly()
    {
        $dataProcess = $this->getProccesData();
        $response = (new WebcheckoutService())->process($dataProcess);

        $internalReference = $response['internalReference'];
        $authorization = $response['authorization'];

        $response = (new WebcheckoutService())->transaction(
            [
                "internalReference" => $internalReference,
                "authorization" => $authorization,
                "action" => "reverse"
            ]);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('APPROVED', $response['status']['status']);
        $this->assertArrayHasKey('internalReference', $response);
        $this->assertArrayHasKey('authorization', $response);
    }

    private function getProccesData(): array
    {
        return [
            'payment' => [
                'reference' => 'TEST_1000',
                'description' => 'Conexion con WebCheckout desde un test',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '50000',
                ]
            ],
            "instrument" => [
                "card" => [
                    "number" => "36545400000008",
                    "expiration" => "12/20",
                    "cvv" => "123",
                    "installments" => 2
                ]
            ]
        ];
    }
}
