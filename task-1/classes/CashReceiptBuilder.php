<?php

namespace app\classes;

class CashReceiptBuilder
{
    private $receipt;
    private $cash_receipt;
    private $parsers;

    public function __construct(string $receipt, array $parsers)
    {
        $this->receipt = $receipt;
        $this->parsers = $parsers;
        $this->build();
    }

    private function build()
    {
        $this->cash_receipt = new CashReceipt();

        foreach ($this->parsers as $parser) {
            /* @var Parser $parser */
            if ($parser->isParsable($this->receipt)) {
                $receipt_items = $parser->getParsedData($this->receipt);
                foreach ($receipt_items as $item) {
                    $this->cash_receipt->addItem($this->createReceiptItem($item));
                }
                break;
            }
        }
    }

    public function createReceiptItem($data): ReceiptItem
    {
        return new ReceiptItem(
            $data["name"] ?? null,
            $data["price"] ?? null,
            $data["quantity"] ?? null
        );
    }

    public function getCashReceipt(): CashReceipt
    {
        return $this->cash_receipt;
    }
}