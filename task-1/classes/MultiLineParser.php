<?php

namespace app\classes;

use app\interfaces\Parser;

class MultiLineParser implements Parser
{
    public function isParsable($item)
    {
        return strpos($item, "\n") !== false || strpos($item, "\r") !== false;
    }

    public function getParsedData($item): array
    {
        return explode("\n", $item);
    }
}