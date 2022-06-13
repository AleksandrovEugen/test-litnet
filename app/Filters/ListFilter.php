<?php

namespace App\Filters;

use App\DTO\Order;

class ListFilter implements BaseFilterInterface
{
    const TYPE_SHOW = 'show';
    const TYPE_HIDE = 'hide';

    public function __construct(
        protected string $fieldName,
        protected array $values,
        protected string $operation,
    )
    {
    }

    public function checkCondition(Order $order): bool
    {
        if (!property_exists($order, $this->fieldName)) {
            return false;
        }

        $methodName = 'get' . ucfirst($this->fieldName);
        $orderValue = $order->$methodName();

        return in_array($orderValue, $this->values);
    }
}
