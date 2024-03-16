<?php

use app\classes\ReceiptItem;
use PHPUnit\Framework\TestCase;

class ReceiptItemTest extends TestCase
{
    public function testConstructorSetsValues()
    {
        $name = "Кроссовки";
        $price = 2000;
        $quantity = 2;

        $item = new ReceiptItem($name, $price, $quantity);

        $this->assertEquals($name, $item->getName());
        $this->assertEquals($price, $item->getPrice());
        $this->assertEquals($quantity, $item->getQuantity());
    }

    public function testConstructorCallsSetters()
    {
        $name = "Кроссовки";
        $price = 2000;
        $quantity = 2;

        $itemMock = $this->getMockBuilder(ReceiptItem::class)
            ->onlyMethods(['setName', 'setPrice', 'setQuantity'])
            ->setConstructorArgs([$name, $price, $quantity])
            ->getMock();

        $itemMock->expects($this->once())->method('setName')->with($name);
        $itemMock->expects($this->once())->method('setPrice')->with($price);
        $itemMock->expects($this->once())->method('setQuantity')->with($quantity);

        $itemMock->__construct($name, $price, $quantity);
    }

    public function testSetNameWorkingAsExpected()
    {
        $receipt_item = new ReceiptItem("футболка", 1000);
        $this->assertEquals("футболка", $receipt_item->getName());
        $receipt_item->setName("брюки");
        $this->assertEquals("брюки", $receipt_item->getName());
    }

    public function testSetPriceWorkingAsExpected()
    {
        $receipt_item = new ReceiptItem("футболка", 1000);
        $this->assertEquals(1000, $receipt_item->getPrice());
        $receipt_item->setPrice(2000);
        $this->assertEquals(2000, $receipt_item->getPrice());
    }

    public function testSetPriceThrowsExceptionWhenPriceNotNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Цена должна быть числом.");
        $receipt_item = new ReceiptItem("футболка", 1000);
        $receipt_item->setPrice("текст");
    }

    public function testSetQuantityThrowsExceptionWhenPriceNotNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Количество должно быть числом.");
        $receipt_item = new ReceiptItem("футболка", 1000, 1);
        $receipt_item->setQuantity("текст");
    }

    public function testSetQuantityThrowsExceptionWhenPriceLowerThanZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Количество не может быть отрицательным.");
        $receipt_item = new ReceiptItem("футболка", 1000, 1);
        $receipt_item->setQuantity(-1);
    }

    public function testSetQuantityMethodSetDefaultValueIfNull()
    {
        $receipt_item = new ReceiptItem("футболка", 1000, null);
        $this->assertEquals(1, $receipt_item->getQuantity());
    }
}