<?php

declare(strict_types=1);

namespace I2crm\Screening\Parser\Exception;

use Exception;

class ParserException extends Exception
{
    public static function wrongCharacters(int $position): self
    {
        return new self(sprintf('Лишние символы после разбора на позиции %d', $position));
    }

    public static function unexpectedCharacter(string $wrongCharacter, string $validCharacter, int $position): self
    {
        return new self(sprintf('Неожиданный символ "%s" на позиции %d, должен быть %s', $wrongCharacter, $position, $validCharacter));
    }

    public static function noFunctionName(int $position): self
    {
        return new self(sprintf('Отсутствует имя функции на позиции %d', $position));
    }

    public static function stringWithoutEnding(int $position): self
    {
        return new self(sprintf('Не завершена строка на позиции %d', $position));
    }

    public static function invalidLiteral(string $literal, int $position): self
    {
        return new self(sprintf('Неизвестный литерал %s на позиции %d', $literal, $position));
    }




}