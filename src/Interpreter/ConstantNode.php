<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

final class ConstantNode extends Node
{
    private mixed $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function evaluate()
    {
        return $this->value;
    }
}