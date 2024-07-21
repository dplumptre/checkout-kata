<?php


use Fluro\Checkout;

require __DIR__ . '/vendor/autoload.php';




// these are Items and prices
$itemAndPrice = [
    'A' => 50.00,
    'B' => 75.00,
    'C' => 25.50,
    'D' => 150.00,
    'E' => 200.00,
];


// the promotions
$promotions = [
    new \Fluro\promotions\DoubleBPromotion( $itemAndPrice, 125),
    new \Fluro\promotions\DEPromotion( $itemAndPrice, 300)
];


// the checkout
$m = new Checkout($itemAndPrice,$promotions);
//$m->scan('A');
//$m->scan('B');
//$m->scan('B');
//$m->scan('B');
$m->scan('E');
$m->scan('D');
$m->scan('E');
$m->scan('D');
$m->scan('E');


echo $m->calculateTotal();
