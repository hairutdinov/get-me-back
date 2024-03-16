<?php

use app\classes\RegularExpressionParser;

class RegularExpressionParserTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorSetsPatternAttribute()
    {
        $pattern = "/^(?P<number>\d+)$/i";

        $item = new RegularExpressionParser($pattern);

        $reflector = new ReflectionClass($item);
        $property = $reflector->getProperty('pattern');
        $property->setAccessible(true);
        $value = $property->getValue($item);

        $this->assertEquals($pattern, $value);
    }


}