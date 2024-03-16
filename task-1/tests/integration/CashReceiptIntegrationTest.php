<?php

use app\classes\CashReceipt;
use app\classes\PercentDiscount;
use app\classes\ReceiptItem;

class CashReceiptIntegrationTest extends \PHPUnit\Framework\TestCase
{
    public function testApplyDiscountToItems()
    {
        $cash_receipt = new CashReceipt();
        $jeans = new ReceiptItem("Джинсы", 4200);
        $tshirt = new ReceiptItem("Футболка", 1800);

        $cash_receipt->addItem($jeans);
        $cash_receipt->addItem($tshirt);

        $discount_percent = 50;
        $discount = new PercentDiscount($discount_percent);
        $cash_receipt->applyDiscountToItems($discount);

        $this->assertEquals(2100, $cash_receipt->getItems()[0]->getDiscountedPrice());
        $this->assertEquals(900, $cash_receipt->getItems()[1]->getDiscountedPrice());
    }
}