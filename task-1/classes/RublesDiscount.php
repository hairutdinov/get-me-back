<?php

namespace app\classes;

use app\interfaces\DiscountTypeInterface;

class RublesDiscount implements DiscountTypeInterface
{
    private $discount_in_rubles;

    public function __construct($discount_in_rubles)
    {
        $this->discount_in_rubles = $discount_in_rubles;
    }

    public function applyDiscount($old_price)
    {
        if ($this->discount_in_rubles > $old_price) {
            return 0;
        }
        return $old_price - $this->discount_in_rubles;
    }
}