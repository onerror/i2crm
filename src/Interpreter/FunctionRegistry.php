<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

use I2crm\Screening\Interpreter\Function\Action\Array\MakeFunction as ArrayMakeFunction;
use I2crm\Screening\Interpreter\Function\Action\Core\GetArgFunction;
use I2crm\Screening\Interpreter\Function\Action\Map\MakeFunction as MapMakeFunction;
use I2crm\Screening\Interpreter\Function\Action\String\ConcatFunction;
use I2crm\Screening\Interpreter\Function\Action\String\JsonEncodeFunction;
use I2crm\Screening\Interpreter\Function\FunctionInterface;
use InvalidArgumentException;

final class FunctionRegistry
{
    /**
     * @var array <string, FunctionInterface>
     */
    private const array FUNCTIONS = [
        'bk.action.core.GetArg' => GetArgFunction::class,
        'bk.action.array.Make' => ArrayMakeFunction::class,
        'bk.action.map.Make' => MapMakeFunction::class,
        'bk.action.string.Concat' => ConcatFunction::class,
        'bk.action.string.JsonEncode' => JsonEncodeFunction::class,
    ];

    public static function execute(string $name, array $params, array $args): mixed
    {
        return self::getFunction($name)->execute($params, $args);
    }

    private static function getFunction(string $name): FunctionInterface
    {
        if (!isset(self::FUNCTIONS[$name])) {
            throw new InvalidArgumentException(sprintf("Функция %s не найдена", $name));
        }
        return new (self::FUNCTIONS[$name])();
    }
}