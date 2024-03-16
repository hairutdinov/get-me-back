<?php

use app\classes\PercentDiscount;
use app\classes\ReceiptItem;

class ReceiptItemIntegrationTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyDiscount()
    {
        $name = "Кроссовки";
        $price = 2000;
        $quantity = 2;

        $item = new ReceiptItem($name, $price, $quantity);

        $discount_percent = 50;
        $discount = new PercentDiscount($discount_percent);
        $item->applyDiscount($discount);

        $reflector = new ReflectionClass($item);
        $property = $reflector->getProperty('discounted_price');
        $property->setAccessible(true);
        $discounted_price = $property->getValue($item);

        $this->assertEquals($price * (1 - ($discount_percent / 100)), $discounted_price);
    }
}