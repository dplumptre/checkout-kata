<?php


use Fluro\Checkout;

require __DIR__ . '/vendor/autoload.php';





$itemAndPrice = [
    'A' => 50.00,
    'B' => 75.00,
    'C' => 25.50,
    'D' => 150.00,
    'E' => 200.00,
];

$promotions = [
   // new \Fluro\promotions\DoubleBPromotion( $itemAndPrice, "B", 125)
    new \Fluro\promotions\DEPromotion( $itemAndPrice, 300)
];


$m = new Checkout($itemAndPrice,$promotions);
//$m->scan('A');
//$m->scan('B');
$m->scan('D');
$m->scan('D');
$m->scan('E');
$m->scan('E');
echo $m->calculateTotal();
