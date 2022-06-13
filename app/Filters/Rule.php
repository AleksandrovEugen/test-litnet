<?php

namespace App\Filters;

use App\DTO\Order;
use Illuminate\Support\Collection;

class Rule
{
    protected Collection $filters;

    public function __construct(
        protected int $paymentMethodId
    )
    {
        $this->filters = collect();
    }

    public function addFilter(BaseFilterInterface $filter)
    {
        $this->filters->push($filter);
    }

    public function checkCondition(Order $order)
    {
        $matched = false;
        foreach ($this->filters as $filter) {
            $matched = $filter->checkCondition($order);

            if (!$matched) {
                return false;
            }
        }

        return $matched;
    }

    /**
     * @return int
     */
    public function getPaymentMethodId(): int
    {
        return $this->paymentMethodId;
    }
}
