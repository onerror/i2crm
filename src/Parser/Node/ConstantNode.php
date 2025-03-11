<?php

declare(strict_types=1);

namespace I2crm\Screening\Parser\Node;

// Узел константы: хранит числовое, строковое или булево значение
final class ConstantNode extends Node
{
    private mixed $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function evaluate($args)
    {
        return $this->value;
    }
}