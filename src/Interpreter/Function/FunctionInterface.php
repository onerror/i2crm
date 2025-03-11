<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter\Function;

interface FunctionInterface
{
    public function getName(): string;

    public function execute(array $params, array $args): mixed;
}