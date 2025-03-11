<?php

declare(strict_types=1);

namespace I2crm\Screening\Tests;

use I2crm\Screening\Interpreter\Interpreter;
use I2crm\Screening\Parser\Parser;
use PHPUnit\Framework\TestCase;

class InterpreterTest extends TestCase
{

    public function testInterpret(): void
    {
        $service = new Interpreter(new Parser());
        $result = $service->interpret(
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
        $this->assertEquals(json_encode(['message' => 'Hello, world']),
            $result,
            'Вывод программы не совпадает с ожидаемым');
    }
}
