<?php

namespace Tests\Feature\Gateway;

use App\Services\WebcheckoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QueryTest extends TestCase
{
    public function testItCanInformationFromServiceCorrectly()
    {
        $data = ['internalReference' => '1549467013'];
        $response = (new WebcheckoutService())->query($data);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('APPROVED', $response['status']['status']);
    }
}
