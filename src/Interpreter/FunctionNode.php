<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

final class FunctionNode extends Node
{
    private string $functionName;
    private array $parameters;

    public function __construct(
        string $functionName,
        array $parameters = [])
    {

        $this->functionName = $functionName;
        $this->parameters = $parameters;
    }

    public function evaluate()
    {
        $evaluatedParams = [];
        foreach ($this->parameters as $param) {
            $evaluatedParams[] = $param->evaluate();
        }

        return FunctionRegistry::getFunction($this->functionName)->execute($evaluatedParams);
    }
}