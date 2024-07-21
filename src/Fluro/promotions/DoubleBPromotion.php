<?php

namespace Fluro\promotions;

use Fluro\enum\PromotionType;

class DoubleBPromotion implements Promotion
{


    private int $target = 2;
    private float $special_price;
    private float $price;



    public function __construct(array $items, float $special_price)
    {
        $this->price = $items[PromotionType::PROMOTION_TYPE_B->value];
        $this->special_price = $special_price;
    }


    public function apply(&$scannedItemsAndCount, &$total):void
    {
            if(!isset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_B->value])) return;
            $AmountOfDoublePromoSku = floor($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_B->value] / $this->target);
            $AmountOfWithoutThePromo = $scannedItemsAndCount[PromotionType::PROMOTION_TYPE_B->value] % $this->target;
            $total += $this->special_price *  $AmountOfDoublePromoSku + $this->price *  $AmountOfWithoutThePromo;
            unset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_B->value]);
    }


}