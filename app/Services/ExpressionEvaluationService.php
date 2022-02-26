<?php

namespace App\Services;

use App\Exceptions\MalformedExpressionException;
use App\Interfaces\SecuritiesRepositoryInterface;
use Illuminate\Support\Facades\App;

class ExpressionEvaluationService
{
    private $securitiesRepository;

    public function __construct()
    {
        $this->securitiesRepository = App::make(SecuritiesRepositoryInterface::class);
    }

    public function evaluate(string $security, array $expression): float
    {
        $function = (string)$expression['fn'] ?? null;
        $argumentA = $this->evaluateArgument($security, $expression['a']) ?? null;
        $argumentB = $this->evaluateArgument($security, $expression['b']) ?? null;

        throw_if(!$function, new MalformedExpressionException('Missing function'));
        throw_if(!$argumentA || !$argumentB, new MalformedExpressionException('Missing expression'));

        $operators = config('securities.operators');

        throw_if(
            !in_array($function, array_keys($operators)),
            new MalformedExpressionException('Unknown operator ' . $function)
        );

        $operatorClass = 'App\\Operators\\' . $operators[$function];
        $operator = new $operatorClass;

        return $operator->getResult((float)$argumentA, (float)$argumentB);
    }

    private function evaluateArgument(string $security, $expression)
    {
        if (is_array($expression)) {
            return $this->evaluate($security, $expression);
        }

        if (is_numeric($expression)) {
            return (int)$expression;
        }

        $attributeValue = $this->securitiesRepository->getAttributeValueForSecurity($security, (string)$expression);
        if ($attributeValue) {
            return $attributeValue;
        }

        throw new MalformedExpressionException("Could not parse expression " . (string)$expression);
    }
}
