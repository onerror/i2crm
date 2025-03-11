<?php

declare(strict_types=1);

namespace I2crm\Screening\Parser;

use I2crm\Screening\Parser\Exception\ParserException;
use I2crm\Screening\Parser\Node\ConstantNode;
use I2crm\Screening\Parser\Node\FunctionNode;
use I2crm\Screening\Parser\Node\Node;

final class Parser implements LanguageParserInterface
{
    private string $input;
    private int $currentPosition;
    private int $length;

    public function __construct()
    {

    }

    public function parse(string $code): Node
    {
        $this->input = $code;
        $this->currentPosition = 0;
        $this->length = strlen($code);
        $expr = $this->parseExpression();

        $this->skipWhitespace();
        if ($this->currentPosition < $this->length) {
            ParserException::wrongCharacters($this->currentPosition);
        }
        return $expr;
    }

    private function skipWhitespace(): void
    {
        while ($this->currentPosition < $this->length && ctype_space($this->input[$this->currentPosition])) {
            $this->currentPosition++;
        }
    }

    private function current(): ?string
    {
        $this->skipWhitespace();
        return $this->currentPosition < $this->length ? $this->input[$this->currentPosition] : null;
    }

    private function forward(): void
    {
        $this->currentPosition++;
    }

    private function consume(): string
    {
        return $this->input[$this->currentPosition++];
    }

    /**
     * @throws ParserException
     */
    private function parseExpression(): FunctionNode|ConstantNode
    {
        $this->skipWhitespace();
        $char = $this->current();
        if ($char === '(') {
            return $this->parseFunctionCall();
        }

        return $this->parseConstant();
    }

    /**
     * Парсит вызов функции вида: (имя_функции) или (имя_функции, expr, expr, ...)
     *
     * @throws ParserException
     */
    private function parseFunctionCall(): FunctionNode
    {
        $char = $this->consume();
        if ($char !== '(') {
            throw ParserException::unexpectedCharacter($char, '(', $this->currentPosition);
        }

        $this->skipWhitespace();
        // Читаем имя функции до запятой или закрывающей скобки
        $functionName = "";
        while ($this->currentPosition < $this->length) {
            $char = $this->current();
            if ($char === ',' || $char === ')') {
                break;
            }
            $functionName .= $this->consume();
        }
        $functionName = trim($functionName);
        if ($functionName === "") {
            throw ParserException::noFunctionName($this->currentPosition);
        }

        $params = [];
        $this->skipWhitespace();
        if ($this->current() === ',') {
            $this->forward();
            $this->skipWhitespace();
            // Читаем первый параметр
            $params[] = $this->parseExpression();
            $this->skipWhitespace();
            // Читаем последующие параметры, если они разделены запятыми
            while ($this->current() === ',') {
                $this->forward();
                $params[] = $this->parseExpression();
                $this->skipWhitespace();
            }
        }
        $char = $this->consume();
        if ($char !== ')') {
            throw ParserException::unexpectedCharacter($char, ')', $this->currentPosition);
        }

        return new FunctionNode($functionName, $params);
    }

    /**
     * @throws ParserException
     */
    private function parseConstant(): ConstantNode
    {
        $this->skipWhitespace();
        $char = $this->current();
        if ($char === '"') {
            return new ConstantNode($this->parseString());
        }

        if (ctype_digit($char)) {
            return new ConstantNode($this->parseNumber());
        }

        $literal = "";
        while ($this->currentPosition < $this->length) {
            $char = $this->current();
            if ($char === ',' || $char === ')' || ctype_space($char)) {
                break;
            }
            $literal .= $this->consume();
        }
        $literal = trim($literal);
        if ($literal === "true") {
            return new ConstantNode(true);
        }

        if ($literal === "false") {
            return new ConstantNode(false);
        }

        if ($literal === "null") {
            return new ConstantNode(null);
        }

        if (is_numeric($literal)) {
            return new ConstantNode(str_contains($literal, '.') ? (float)$literal : (int)$literal);
        }

        throw ParserException::invalidLiteral($literal, $this->currentPosition);
    }

    /**
     * Парсит строку в двойных кавычках
     */
    private function parseString(): string
    {
        $char = $this->consume();
        if ($char !== '"') {
            throw ParserException::unexpectedCharacter($char, '"', $this->currentPosition);
        }
        $str = "";
        while ($this->currentPosition < $this->length) {
            $char = $this->consume();
            if ($char === '"') {
                return $str;
            }
            $str .= $char;
        }
        throw ParserException::stringWithoutEnding($this->currentPosition);
    }

    private function parseNumber(): float|int
    {
        $numStr = "";
        while ($this->currentPosition < $this->length) {
            $char = $this->current();
            if (ctype_digit($char) || $char === '.') {
                $numStr .= $this->consume();
            } else {
                break;
            }
        }
        return str_contains($numStr, '.') ? (float)$numStr : (int)$numStr;
    }
}