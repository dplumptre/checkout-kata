<?php

namespace Fluro\promotions;

use Fluro\enum\PromotionType;

class DEPromotion implements Promotion
{



    private float $special_price;
    private array $items;

    public function __construct(array $items, float $special_price)
    {

        $this->items = $items;
        $this->special_price = $special_price;
    }

    public function apply(&$scannedItemsAndCount, &$total):void
    {


        if( isset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_D->value])  && isset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_E->value])){

            $dCount = $scannedItemsAndCount[PromotionType::PROMOTION_TYPE_D->value];
            $eCount = $scannedItemsAndCount[PromotionType::PROMOTION_TYPE_E->value];

            $pair_count = min($dCount,$eCount);
            $total += $this->special_price *  $pair_count;

            $newItemsAndCount[PromotionType::PROMOTION_TYPE_D->value] =   $dCount - $pair_count;
            $newItemsAndCount[PromotionType::PROMOTION_TYPE_E->value] =   $eCount - $pair_count;

            foreach ($newItemsAndCount as $sku => $count) {
                $total += $this->items[$sku] *  $count;
            }

            unset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_D->value]);
            unset($scannedItemsAndCount[PromotionType::PROMOTION_TYPE_E->value]);
        }





    }
}