<?php

namespace Fluro\promotions;

use Fluro\enum\PromotionType;

class DEPromotion implements Promotion
{


    private int $target = 3;
    private float $special_price;
    private array $items;

    public function __construct(array $items, float $special_price)
    {

        $this->items = $items;
        $this->special_price = $special_price;
    }

    public function apply(&$scannedItemsAndCount, &$total):void
    {

        if(isset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_D->value])){
            $skuD =  PromotionType::PROMOTION_TYPE_D->value;
        }

        if(isset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_E->value])){
            $skuE =  PromotionType::PROMOTION_TYPE_E->value;
        }


        if( $skuE === null && $skuD === null )return;

        $price = $this->items[$sku];
        $AmountOfDoublePromoSku = floor($scannedItemsAndCount[$sku] / $this->target);
        $AmountOfWithoutThePromo = $scannedItemsAndCount[$sku] % $this->target;
        $total += $this->special_price *  $AmountOfDoublePromoSku + $price *  $AmountOfWithoutThePromo;
        unset($scannedItemsAndCount[$sku]);
    }
}