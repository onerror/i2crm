<?php

declare(strict_types=1);

namespace I2crm\Screening\Parser;

use I2crm\Screening\Parser\Node\Node;

interface LanguageParserInterface
{
    public function parse(string $code): Node;
}