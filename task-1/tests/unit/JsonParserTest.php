<?php

use app\classes\JsonParser;

class JsonParserTest extends \PHPUnit\Framework\TestCase
{
    public function testIsParsableMethodReturnsTrue()
    {
        $valid_json = '[{"name": "Ivan"}, {"name": "Alena"}]';
        $json_parser = new JsonParser();
        $this->assertTrue($json_parser->isParsable($valid_json));
    }

    public function testIsParsableMethodReturnsFalse()
    {
        $invalid_json = 'Просто текст';
        $json_parser = new JsonParser();
        $this->assertFalse($json_parser->isParsable($invalid_json));
    }

    public function testGetParsedDataMethod()
    {
        $text = '[{"name": "Ivan"}, {"name": "Alena"}]';
        $expected_json = [
            ["name" => "Ivan"],
            ["name" => "Alena"],
        ];
        $json_parser = new JsonParser();
        $this->assertEquals($expected_json, $json_parser->getParsedData($text));
    }

    public function testGetParsedDataMethodReturnsNullWithInvalidJson()
    {
        $text = 'Просто текст';
        $json_parser = new JsonParser();
        $parsed_data = $json_parser->getParsedData($text);
        $this->assertIsArray($parsed_data);
        $this->assertEquals([], $parsed_data);
    }
}