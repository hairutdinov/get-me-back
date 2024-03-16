<?php

namespace app\classes;

use app\interfaces\Parser;

class JsonParser implements Parser
{
    private $parsed_data;

    public function isParsable($item)
    {
        json_decode($item, 1);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function getParsedData($item): array
    {
        $this->parsed_data = json_decode($item, 1);
        if (empty($this->parsed_data)) {
            return [];
        }
        return $this->parsed_data;
    }
}
