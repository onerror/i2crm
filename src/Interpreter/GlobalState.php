<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

class GlobalState
{
    private static array $arguments = [];

    public static function setArguments(array $arguments): void
    {
        self::$arguments = $arguments;
    }

    public static function getArgument(int $index, mixed $default = null): mixed
    {
        return self::$arguments[$index] ?? $default;
    }
}