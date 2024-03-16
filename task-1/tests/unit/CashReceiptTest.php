<?php

use app\classes\CashReceipt;
use app\classes\ReceiptItem;
use PHPUnit\Framework\TestCase;

class CashReceiptTest extends TestCase
{
    public function testAddItem()
    {
        $cash_receipt = new CashReceipt();
        $jeans = new ReceiptItem("Джинсы", 4500, 1);
        $tshirt = new ReceiptItem("Футболка", 1800, 2);

        $cash_receipt->addItem($jeans);
        $cash_receipt->addItem($tshirt);

        $this->assertCount(2, $cash_receipt->getItems());

        $this->assertSame($cash_receipt->getItems()[0], $jeans);
        $this->assertSame($cash_receipt->getItems()[1], $tshirt);
    }
}