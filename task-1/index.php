<?php

require_once "vendor/autoload.php";

use app\classes\RegularExpressionParser;
use app\classes\JsonParser;
use app\classes\CashReceiptBuilder;
use app\classes\RublesDiscount;
use app\classes\PercentDiscount;

const TASK_DESCRIPTION = <<<HERE
Кассовый чек может содержать одну или несколько позиций, например:

Чек 1:
Кроссовки: 2000₽, 
Шорты: 1000₽,
Футболка: 500₽. 

Чек 2:
Шорты 1шт. 1000₽ 
Платье 1шт. 1000₽ 
Юбка 1шт. 1000₽ 

Покупателю может быть предоставлена скидка: либо N рублей на весь чек, либо M% на весь чек.

Вам необходимо написать функцию, которая распределит скидку по всем позициям в чеке и вывести стоимость каждой единицы товара с учётом скидки.
HERE;

$receipts = [
    "Кроссовки: 2000₽,
Шорты: 1000₽,
Футболка: 500₽.",
    "Шорты 1шт. 1000₽
Платье 1шт. 3000₽
Юбка 1шт. 4999₽",
    "Стул 2шт. 14000₽,
Стол 1шт. 3500.99₽.",
    '[
      {
        "name": "Кроссовки",
        "price": 2000
      },
      {
        "name": "Стул",
        "price": 14000,
        "quantity": 2
      }
    ]'
];

$discounts = [
    new RublesDiscount(7),
    new RublesDiscount(2000),
    new PercentDiscount(15),
    new PercentDiscount(50),
];

for ($i = 0; $i < count($receipts); $i++) {
    $receipt = $receipts[$i];
    $discount = $discounts[$i];

    $first_regex_parser = new RegularExpressionParser('/^(?P<name>[а-яА-Я]+)\s?\:\s?(?P<price>\d+(\.\d+)?)₽(?:,|\.)?$/ui');
    $second_regex_parser = new RegularExpressionParser('/^(?P<name>[а-яА-Я]+)\s(?P<quantity>\d+)шт\.\s(?P<price>\d+(\.\d+)?)₽(?:,|\.)?/ui');

    $parsers = [new JsonParser(), $first_regex_parser, $second_regex_parser];

    $cash_receipt_builder = new CashReceiptBuilder($receipt, $parsers);
    $cash_receipt = $cash_receipt_builder->getCashReceipt();
    $cash_receipt->applyDiscountToItems($discount);

//    echo "<pre>" . print_r($cash_receipt->getItems(), 1) . "</pre>";
    var_dump($cash_receipt->getItems());
}
