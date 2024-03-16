<?php

use app\classes\RegularExpressionParser;

class RegularExpressionParserIntegrationTest extends \PHPUnit\Framework\TestCase
{
    public function testIsParsableReturnsTrue()
    {
        $pattern = '/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui';
        $content = "Кроссовки: 2000₽,
Футболка: 500₽.";

        $parser = new RegularExpressionParser($pattern);

        $this->assertTrue($parser->isParsable($content));
    }

    public function testIsParsableReturnsFalse()
    {
        $pattern = '/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui';
        $content = "Кроссовки: 2000₽,Футболка: 500₽.";

        $parser = new RegularExpressionParser($pattern);

        $this->assertFalse($parser->isParsable($content));
    }

    public function testIsParsableReturnsFalseEvenWhenOnlyOneLineNotMatches()
    {
        $pattern = '/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui';
        $content = "Кроссовки: 2000₽,
Футболка: ₽.";

        $parser = new RegularExpressionParser($pattern);

        $this->assertFalse($parser->isParsable($content));
    }

    public function testGetParsedData()
    {
        $pattern = '/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui';
        $content = "Кроссовки: 2000₽,
Футболка: 500₽.";
        $parser = new RegularExpressionParser($pattern);

        $parsed_data = $parser->getParsedData($content);

        $this->assertNotEmpty($parsed_data);
        $this->assertIsArray($parsed_data);
        $this->assertCount(2, $parsed_data);
        $this->assertEquals([
            0 => "Кроссовки: 2000₽,",
            1 => "Кроссовки",
            2 => "2000",
            "name" => "Кроссовки",
            "price" => "2000",
        ], $parsed_data[0]);
        $this->assertEquals([
            0 => "Футболка: 500₽.",
            1 => "Футболка",
            2 => "500",
            "name" => "Футболка",
            "price" => "500",
        ], $parsed_data[1]);
    }
}