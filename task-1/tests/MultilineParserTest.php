<?php

use app\classes\MultiLineParser;

class MultilineParserTest extends \PHPUnit\Framework\TestCase
{
    public function testIsParsableMethodReturnsTrue()
    {
        $content_with_line_breaks = "Line 1\nLine2";
        $json_parser = new MultiLineParser();
        $this->assertTrue($json_parser->isParsable($content_with_line_breaks));
    }

    public function testIsParsableMethodReturnsFalse()
    {
        $content_without_line_breaks = 'Просто текст';
        $json_parser = new MultiLineParser();
        $this->assertFalse($json_parser->isParsable($content_without_line_breaks));
    }

    public function testGetParsedDataMethod()
    {
        $content = "Line 1\nLine2";
        $expected = ["Line 1", "Line2"];
        $json_parser = new MultiLineParser();
        $this->assertEquals($expected, $json_parser->getParsedData($content));
    }

    public function testGetParsedDataMethodReturnsArrayWhenThereIsNoLineBreaks()
    {
        $text = 'Просто текст';
        $expected = [$text];
        $json_parser = new MultiLineParser();
        $parsed_data = $json_parser->getParsedData($text);
        $this->assertIsArray($parsed_data);
        $this->assertEquals($expected, $parsed_data);
    }
}