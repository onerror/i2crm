<?php

declare(strict_types=1);

use I2crm\Screening\Interpreter\Interpreter;
use I2crm\Screening\Parser\Parser;

require_once 'vendor/autoload.php';

// Пример программы из условия задачи
$code = '(bk.action.string.JsonEncode, 
    (bk.action.map.Make, 
        (bk.action.array.Make, "message"), 
        (bk.action.array.Make, 
            (bk.action.string.Concat, "Hello, ", (bk.action.core.GetArg, 0))
        )
    )
)';

$interpreter = new Interpreter(
    new Parser(),
);

$result = $interpreter->interpret($code, ['world']);
echo $result . "\n";  // Вывод: {"message":"Hello, world"}