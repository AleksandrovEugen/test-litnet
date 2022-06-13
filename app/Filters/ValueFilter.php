<?php

namespace App\Filters;

use App\DTO\Order;

class ValueFilter implements BaseFilterInterface
{
    const OPERATION_TYPE_EQUAL = '===';
    const OPERATION_TYPE_LT = '<';

    public function __construct(
        protected string $fieldName,
        protected string $value,
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

        if ($this->operation === self::OPERATION_TYPE_EQUAL) {
            return $orderValue == $this->value;
        }

        if ($this->operation === self::OPERATION_TYPE_LT) {
            return $orderValue < $this->value;
        }
    }
}
