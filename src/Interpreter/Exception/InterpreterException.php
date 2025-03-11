<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Exception;

use Exception;

class InterpreterException extends Exception
{
    public static function incorrectParamNumber(string $functionName, int $correctNumber, int $gotNumber): self
    {
        return new self(sprintf("%s ожидает %d параметров, получил %d", $functionName, $correctNumber, $gotNumber));
    }

    public static function incorrectParamType(string $functionName, int $paramIndex): self
    {
        return new self(sprintf("%s получил получила неправильный тип параметра с индексом %d", $functionName, $paramIndex));
    }

}