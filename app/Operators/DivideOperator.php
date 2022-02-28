<?php

namespace App\Operators;

use App\Operators\OperatorInterface;

class DivideOperator implements OperatorInterface
{
    public function getResult(float $argumentA, float $argumentB): float
    {
        return bcdiv($argumentA, $argumentB);
    }
}
