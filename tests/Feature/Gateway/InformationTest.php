<?php

namespace Tests\Feature\Gateway;

use App\Services\WebcheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InformationTest extends TestCase
{
    public function testItCanInformationFromServiceCorrectly()
    {
        $data = $this->getInformationData();
        $response = (new WebcheckoutService())->information($data);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('OK', $response['status']['status']);
        $this->assertArrayHasKey('credits', $response);
    }

    private function getInformationData(): array
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
            "instrument" => [
                "card" => [
                    "number" => "4110760000000008"
                ]
            ]
        ];
    }

}
