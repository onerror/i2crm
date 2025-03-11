<?php

declare(strict_types=1);

use I2crm\Screening\Interpreter\Interpreter;

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

$interpreter =
    new Interpreter();

$result = $interpreter->interpret($code, ['world']);
echo $result . "\n";  // Вывод: {"message":"Hello, world"}