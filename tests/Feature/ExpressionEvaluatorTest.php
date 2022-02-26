<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Services\ExpressionEvaluationService;

class ExpressionEvaluatorTest extends TestCase
{
    private $evaluator;

    public function setUp(): void
    {
        parent::setUp();

        $this->evaluator = $this->app->make(ExpressionEvaluationService::class);
    }

    public function testNumericValuesEvaluateCorrectly()
    {
        $result = $this->evaluator->evaluate("ABC", [
            "fn" => "+",
            "a" => "3",
            "b" => 6,
        ]);

        $this->assertEquals(9, $result);
    }

    public function testAttributeValuesEvaluateCorrectly()
    {
        $result = $this->evaluator->evaluate("ABC", [
            "fn" => "+",
            "a" => "debt",  // 9
            "b" => "price", // 1
        ]);

        $this->assertEquals(10, $result);
    }

    public function testNestedExpressionsEvaluateCorrectly()
    {
        $result = $this->evaluator->evaluate("ABC", [
            "fn" => "-",
            "a" => [
                "fn" => "*",
                "a" => 5,
                "b" => "ebitda" //5
            ],  //25
            "b" => "shares",  //10
        ]);

        $this->assertEquals(15, $result);
    }
}
