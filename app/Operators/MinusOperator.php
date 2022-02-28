<?php

namespace App\Operators;

use App\Operators\OperatorInterface;

class MinusOperator implements OperatorInterface
{
    public function getResult(float $argumentA, float $argumentB): float
    {
        return bcsub($argumentA, $argumentB);
    }
}
