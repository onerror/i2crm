<?php

declare(strict_types=1);

namespace I2crm\Screening\Interpreter;

use I2crm\Screening\Parser\LanguageParserInterface;

final class Interpreter
{


    public function __construct(private readonly LanguageParserInterface $parser)
    {
    }

    public function interpret($code, $args = []):mixed
    {
        return $this->parser->parse($code)->evaluate($args);
    }
}