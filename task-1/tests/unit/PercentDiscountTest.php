<?php

use app\classes\PercentDiscount;

class PercentDiscountTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorSetsDiscountPercentAttribute()
    {
        $percent = 50;

        $item = new PercentDiscount($percent);

        $reflector = new ReflectionClass($item);
        $property = $reflector->getProperty('discount_percent');
        $property->setAccessible(true);
        $value = $property->getValue($item);

        $this->assertEquals($percent, $value);
    }

    public function testApplyDiscountMethod()
    {
        $percent = 50;
        $price = 222;
        $percent_discount = new PercentDiscount($percent);
        $discounted_price = $price * (1 - $percent / 100);
        $this->assertEquals($discounted_price, $percent_discount->applyDiscount($price));
    }

    public function testGetDiscountPercentGetter()
    {
        $percent = 50;
        $percent_discount = new PercentDiscount($percent);
        $this->assertEquals($percent, $percent_discount->getDiscountPercent());
    }
}