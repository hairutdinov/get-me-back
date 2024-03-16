<?php

namespace app\classes;

use app\interfaces\DiscountTypeInterface;

class CashReceipt
{
    private $items = [];

    public function addItem(ReceiptItem $item)
    {
        $this->items[] = $item;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function applyDiscountToItems(DiscountTypeInterface $discountType)
    {
        foreach ($this->items as $item) {
            /* @var ReceiptItem $item  */
            $item->applyDiscount($discountType);
        }
    }
}