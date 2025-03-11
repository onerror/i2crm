<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function\Action\String;

use I2crm\Screening\Interpreter\Exception\InterpreterException;
use I2crm\Screening\Interpreter\Function\AbstractFunction;
use JsonException;

class JsonEncodeFunction extends AbstractFunction
{

    public function getName(): string
    {
        return 'bk.action.string.JsonEncode';
    }

    /**
     * @throws InterpreterException
     */
    public function execute(array $params): mixed
    {
        $this->validateParamCount($params, 1);
        try {
            return json_encode($params[0], JSON_THROW_ON_ERROR);
        }catch(JsonException){
            throw InterpreterException::incorrectParamType($this->getName(), $params[0]);
        }
    }
}