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

    public function evaluate(array $args)
    {
        $evaluatedParams = [];
        foreach ($this->parameters as $param) {
            $evaluatedParams[] = $param->evaluate($args);
        }

        return FunctionRegistry::execute($this->functionName, $evaluatedParams, $args);
    }
}