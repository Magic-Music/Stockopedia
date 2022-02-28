<?php

namespace App\Operators;

interface OperatorInterface
{
    public function getResult(float $argumentA, float $argumentB): float;
}
