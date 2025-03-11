<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function\Action\Array;

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
    public function execute(array $params): array
    {
        $this->validateParamCount($params, 1);
        return $params;
    }
}