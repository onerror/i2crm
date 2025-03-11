<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function\Action\Core;

use I2crm\Screening\Interpreter\Exception\InterpreterException;
use I2crm\Screening\Interpreter\Function\AbstractFunction;
use I2crm\Screening\Interpreter\GlobalState;

class GetArgFunction extends AbstractFunction
{
    public function getName(): string
    {
        return 'bk.action.core.GetArg';
    }

    /**
     * @throws InterpreterException
     */
    public function execute(array $params): mixed
    {
        $this->validateParamCount($params, 1);
        $index = $params[0];

        if (!is_int($index)) {
            throw InterpreterException::incorrectParamType($this->getName(), 0);
        }

        return GlobalState::getArgument($index);
    }
}