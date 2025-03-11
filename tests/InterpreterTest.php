<?php

declare(strict_types=1);

namespace I2crm\Screening\Tests;

use I2crm\Screening\Interpreter\Interpreter;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{

    public function testInterpret(): void
    {
        $result = new Interpreter()->interpret(
            <<<'CODE'
(bk.action.string.JsonEncode, 
    (bk.action.map.Make, 
        (bk.action.array.Make, "message"), 
        (bk.action.array.Make, 
            (bk.action.string.Concat, "Hello, ", (bk.action.core.GetArg, 0))
        )
    )
)
CODE,
            ['world']
        );
        $this->assertEquals(json_encode(['message' => 'Hello, world'], JSON_THROW_ON_ERROR),
            $result,
            'Вывод программы не совпадает с ожидаемым');
    }
}
