<?php

namespace app\classes;

use app\interfaces\DiscountTypeInterface;

class PercentDiscount implements DiscountTypeInterface
{
    private $discount_percent;

    public function __construct($discount_percent)
    {
        $this->discount_percent = $discount_percent;
    }

    public function applyDiscount($old_price)
    {
        return $old_price * (1 - ($this->discount_percent / 100));
    }

    public function getDiscountPercent()
    {
        return $this->discount_percent;
    }
}