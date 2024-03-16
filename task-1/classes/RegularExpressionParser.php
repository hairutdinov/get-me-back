<?php

namespace app\classes;

use app\interfaces\Parser;

class RegularExpressionParser extends MultiLineParser implements Parser
{
    private $pattern;
    private $parsed_data;

    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    public function isParsable($item)
    {
        if (!parent::isParsable($item)) {
            return false;
        }

        foreach (parent::getParsedData($item) as $line) {
            if (!preg_match($this->pattern, $line)) {
                return false;
            }
        }

        return true;
    }

    public function getParsedData($item): array
    {
        foreach (parent::getParsedData($item) as $line) {
            $parsed_data = null;
            preg_match($this->pattern, $line, $parsed_data);
            $this->parsed_data[] = $parsed_data;
        }

        return $this->parsed_data;
    }
}