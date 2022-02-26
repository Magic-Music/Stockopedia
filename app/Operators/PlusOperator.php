<?php

namespace App\Operators;

use App\Interfaces\OperatorInterface;

class PlusOperator implements OperatorInterface
{
    public function getResult(float $argumentA, float $argumentB)
    {
        return $argumentA + $argumentB;
    }
}
