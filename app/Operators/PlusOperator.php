<?php

namespace App\Operators;

use App\Operators\OperatorInterface;

class PlusOperator implements OperatorInterface
{
    public function getResult(float $argumentA, float $argumentB): float
    {
        return $argumentA + $argumentB;
    }
}
