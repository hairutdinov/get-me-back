<?php

namespace app\interfaces;

interface DiscountTypeInterface
{
    public function applyDiscount($old_price);
}