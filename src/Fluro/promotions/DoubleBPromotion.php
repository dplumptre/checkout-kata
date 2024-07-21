<?php

namespace Fluro\promotions;

use Fluro\enum\PromotionType;

class DoubleBPromotion implements Promotion
{

    private string  $sku;
    private int $target = 2;
    private float $special_price;
    private float $price;



    public function __construct(array $items, float $special_price)
    {
        $this->sku = PromotionType::PROMOTION_TYPE_B->value;
        $this->price = $items[PromotionType::PROMOTION_TYPE_B->value];
        $this->special_price = $special_price;
    }


    public function apply(&$scannedItemsAndCount, &$total):void
    {

            if(!isset($scannedItemsAndCount[$this->sku])) return;
            $AmountOfDoublePromoSku = floor($scannedItemsAndCount[$this->sku] / $this->target);
            $AmountOfWithoutThePromo = $scannedItemsAndCount[$this->sku] % $this->target;
            $total += $this->special_price *  $AmountOfDoublePromoSku + $this->price *  $AmountOfWithoutThePromo;
            unset($scannedItemsAndCount[$this->sku]);

    }


}