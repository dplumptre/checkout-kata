<?php

namespace Fluro\promotions;

interface Promotion
{
    public function apply(&$scannedItemsAndCount,&$total);
}