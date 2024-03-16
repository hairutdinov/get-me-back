<?php

use app\classes\RublesDiscount;

class RublesDiscountTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructorSetsDiscountPercentAttribute()
    {
        $discount_value_in_rub = 5;

        $item = new RublesDiscount($discount_value_in_rub);

        $reflector = new ReflectionClass($item);
        $property = $reflector->getProperty('discount_in_rubles');
        $property->setAccessible(true);
        $value = $property->getValue($item);

        $this->assertEquals($discount_value_in_rub, $value);
    }

    public function testApplyDiscountMethod()
    {
        $discount_value_in_rub = 5;
        $price = 225;
        $discount_in_rub = new RublesDiscount($discount_value_in_rub);
        $discounted_price = $price - $discount_value_in_rub;
        $this->assertEquals($discounted_price, $discount_in_rub->applyDiscount($price));
    }

    public function testApplyDiscountReturnsZeroIfDiscountGraterThanPrice()
    {
        $discount_value_in_rub = 500;
        $price = 225;
        $discount_in_rub = new RublesDiscount($discount_value_in_rub);
        $this->assertEquals(0, $discount_in_rub->applyDiscount($price));
    }

    public function testGetDiscountInRublesGetter()
    {
        $discount_value_in_rub = 500;
        $discount_in_rub = new RublesDiscount($discount_value_in_rub);
        $this->assertEquals($discount_value_in_rub, $discount_in_rub->getDiscountInRubles());
    }
}