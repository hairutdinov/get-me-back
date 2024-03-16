<?php

namespace app\interfaces;

interface Parser
{
    public function isParsable($item);
    public function getParsedData($item): array;
}