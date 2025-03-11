<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

abstract class Node
{
    abstract public function evaluate(array $args);
}