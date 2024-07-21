<?php

namespace Fluro\promotions;

use Fluro\enum\PromotionType;

class CPromotion implements Promotion
{

    private int $target = 4; // because its 3
    private float $special_price;
    private float $price;



    public function __construct(array $items, float $special_price)
    {
        $this->price = $items[PromotionType::PROMOTION_TYPE_C->value];
        $this->special_price = $special_price;
    }

    public function apply(&$scannedItemsAndCount, &$total)
    {
        if(!isset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_C->value])) return;
        $AmountOfCPromoSku = floor($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_C->value] / $this->target);
        $AmountOfWithoutThePromo = $scannedItemsAndCount[PromotionType::PROMOTION_TYPE_C->value] % $this->target;
        $total += $this->special_price *  $AmountOfCPromoSku + $this->price *  $AmountOfWithoutThePromo;
        unset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_C->value]);
    }
}