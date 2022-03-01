<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Operators\PlusOperator;
use App\Operators\MinusOperator;
use App\Operators\MultiplyOperator;
use App\Operators\DivideOperator;

class OperatorTest extends TestCase
{
    public function testPlusOperatorSumsCorrectly()
    {
        $operator = new PlusOperator;

        $this->assertEquals(7, $operator->getResult(3, 4));
        $this->assertNotEquals(10, $operator->getResult(4, 2));
    }

    public function testMinusOperatorSubtractsCorrectly()
    {
        $operator = new MinusOperator;

        $this->assertEquals(5, $operator->getResult(8, 3));
        $this->assertNotEquals(8, $operator->getResult(6, 5));
    }

    public function testMultiplyOperatorMultipliesCorrectly()
    {
        $operator = new MultiplyOperator;

        $this->assertEquals(35, $operator->getResult(5, 7));
        $this->assertNotEquals(10, $operator->getResult(2, 4));
    }

    public function testDivideOperatorDividesCorrectly()
    {
        $operator = new DivideOperator;

        $this->assertEquals(5, $operator->getResult(20, 4));
        $this->assertNotEquals(8, $operator->getResult(10, 3));
    }
}
