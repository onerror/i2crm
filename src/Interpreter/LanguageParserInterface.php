<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

interface LanguageParserInterface
{
    public function interpret(string $code): string;
}