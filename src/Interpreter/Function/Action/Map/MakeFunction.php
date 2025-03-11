<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function\Action\Map;

use I2crm\Screening\Interpreter\Exception\InterpreterException;
use I2crm\Screening\Interpreter\Function\AbstractFunction;

class MakeFunction extends AbstractFunction
{
    public function getName(): string
    {
        return 'bk.action.array.Make';
    }

    /**
     * @throws InterpreterException
     */
    public function execute(array $params, array $args): mixed
    {
        $this->validateParamCount($params, 2);
        [$keys, $values] = $params;
        if (!is_array($keys)) {
            throw InterpreterException::incorrectParamType($this->getName(), 0);
        }
        if (!is_array($values)) {
            throw InterpreterException::incorrectParamType($this->getName(), 1);
        }
        return array_combine($keys, $values);
    }
}