<?php

use app\classes\CashReceiptBuilder;
use app\classes\RegularExpressionParser;

class CashReceiptBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorSetsAttributes()
    {
        $parsers = [new RegularExpressionParser('/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui')];
        $receipt = "Кроссовки: 2000₽,
Футболка: 500₽.";

        $item = new CashReceiptBuilder($receipt, $parsers);

        $reflector = new ReflectionClass($item);
        $property_receipt = $reflector->getProperty('receipt');
        $property_parsers = $reflector->getProperty('parsers');

        $property_receipt->setAccessible(true);
        $property_parsers->setAccessible(true);

        $this->assertEquals($receipt, $property_receipt->getValue($item));
        $this->assertEquals($parsers, $property_parsers->getValue($item));
    }
}