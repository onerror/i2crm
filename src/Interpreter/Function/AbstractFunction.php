<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function;

use I2crm\Screening\Interpreter\Exception\FunctionException;
use I2crm\Screening\Interpreter\Exception\InterpreterException;

abstract class AbstractFunction implements FunctionInterface
{
    abstract public function getName(): string;

    abstract public function execute(array $params, array $args): mixed;

    /**
     * @throws InterpreterException
     */
    protected function validateParamCount(array $params, int $expected): void
    {
        if (count($params) !== $expected) {
            throw FunctionException::incorrectParamNumber($this->getName(), count($params),$expected);
        }
    }
}