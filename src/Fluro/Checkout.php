<?php


namespace Fluro;



use Fluro\enum\PromotionType;

class Checkout
{

    private array $scannedItemsAndCount = [];

    private array $promotions;
    private array $itemAndPrice;

    public function __construct($itemAndPrice, array $promotions)
    {
        $this->promotions = $promotions;
        $this->itemAndPrice = $itemAndPrice;
    }


    public function scan($itemName): void
    {
        if(!isset($this->scannedItemsAndCount[$itemName])){
            $this->scannedItemsAndCount[$itemName] = 0;
        }
        $this->scannedItemsAndCount[$itemName]++;
    }

    public function calculateTotal(): float
    {
        $total = 0;

        foreach ($this->promotions as $promotion) {
            $promotion->apply($this->scannedItemsAndCount,$total);
        }

        foreach ($this->scannedItemsAndCount as $sku => $count ) {
            $total += $count * $this->itemAndPrice[$sku];
        }
        return $total;
    }



}