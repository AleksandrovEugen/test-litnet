<?php

namespace App\Filters;

use App\DTO\Order;

interface BaseFilterInterface
{
    public function checkCondition(Order $order): bool;
}
