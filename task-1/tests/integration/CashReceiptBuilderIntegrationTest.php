<?php

use app\classes\CashReceipt;
use app\classes\CashReceiptBuilder;
use app\classes\RegularExpressionParser;

class CashReceiptBuilderIntegrationTest extends \PHPUnit\Framework\TestCase
{
    public function testBuildMethod()
    {
        $parsers = [new RegularExpressionParser('/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui')];
        $receipt = "Кроссовки: 2000₽,
Футболка: 500₽.";

        $item = new CashReceiptBuilder($receipt, $parsers);
        $cash_receipt = $item->getCashReceipt();
        $this->assertInstanceOf(CashReceipt::class, $cash_receipt);
        $receipt_items = $cash_receipt->getItems();
        $this->assertCount(2, $receipt_items);

        $this->assertEquals("Кроссовки", $receipt_items[0]->getName());
        $this->assertEquals(2000, $receipt_items[0]->getPrice());
        $this->assertEquals(1, $receipt_items[0]->getQuantity());

        $this->assertEquals("Футболка", $receipt_items[1]->getName());
        $this->assertEquals(500, $receipt_items[1]->getPrice());
        $this->assertEquals(1, $receipt_items[1]->getQuantity());
    }
}