<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function testAWellFormedRequestReturnsCorrectResult()
    {
        $data = [
            "security" => "ABC",
            "expression" => [
                "fn" => "+",
                "a" => "debt",  // 9
                "b" => "price", // 1
            ]
        ];

        $response = $this->postJson('api/evaluate', $data);

        $response->assertStatus(200);
        $response->assertJson(['result' => 10]);
    }

    public function testMissingSecurityReturnsError()
    {
        $data = [
            "expression" => [
                "fn" => "+",
                "a" => "debt",  // 9
                "b" => "price", // 1
            ]
        ];

        $response = $this->postJson('api/evaluate', $data);

        $response->assertStatus(400);
    }

    public function testMissingFunctionReturnsError()
    {
        $data = [
            "security" => "ABC",
            "expression" => [
                "a" => "debt",  // 9
                "b" => "price", // 1
            ]
        ];

        $response = $this->postJson('api/evaluate', $data);

        $response->assertStatus(400);
    }

    public function testMissingArgumentReturnsError()
    {
        $data = [
            "security" => "ABC",
            "expression" => [
                "fn" => "+",
                "b" => "price", // 1
            ]
        ];

        $response = $this->postJson('api/evaluate', $data);

        $response->assertStatus(400);
    }

    public function testMissingExpressionReturnsError()
    {
        $data = [
            "security" => "ABC",
        ];

        $response = $this->postJson('api/evaluate', $data);

        $response->assertStatus(400);
    }
}
