<?php

namespace app\classes;

use app\interfaces\DiscountTypeInterface;
use InvalidArgumentException;

/**
 * @property string $name
 * @property double|integer $price
 * @property integer $quantity
 * */
class ReceiptItem
{
    private $name;
    private $price;
    private $discounted_price;
    private $quantity;

    public function __construct(string $name, $price, $quantity = 1)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        if (!is_numeric($price)) {
            throw new InvalidArgumentException("Цена должна быть числом.");
        }
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setQuantity($quantity)
    {
        if ($quantity === null) {
            $quantity = 1;
        }

        if (!is_numeric($quantity)) {
            throw new InvalidArgumentException("Количество должно быть числом.");
        }

        if ($quantity < 0) {
            throw new InvalidArgumentException("Количество не может быть отрицательным.");
        }

        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function applyDiscount(DiscountTypeInterface $discountType)
    {
        $this->discounted_price = $discountType->applyDiscount($this->price);
    }
}