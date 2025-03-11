<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function\Action\String;

use I2crm\Screening\Interpreter\Exception\InterpreterException;
use I2crm\Screening\Interpreter\Function\AbstractFunction;
use JsonException;

class ConcatFunction extends AbstractFunction
{

    public function getName(): string
    {
        return 'bk.action.string.Concat';
    }

    /**
     * @throws InterpreterException
     */
    public function execute(array $params): mixed
    {
        $this->validateParamCount($params, 2);
        return $params[0] . $params[1];
    }
}