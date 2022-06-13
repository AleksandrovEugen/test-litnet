<?php

namespace App\Filters;

use App\DTO\Order;
use Illuminate\Support\Collection;

class PaymentMethodFilter
{
    public function __construct(
        protected RulesBuilder $rulesBuilder,
        protected Collection $paymentMethods,
    )
    {
    }

    public function filter(Order $order)
    {
        // Первым делом найти исключающие другие правила
        $hideOthersRules = $this->rulesBuilder->getHideOthersRules();
        if (!empty($hideOthersRules)) {
            foreach ($hideOthersRules as $hideOthersRule) {
                if ($hideOthersRule->checkCondition($order)) {
                    return $this->paymentMethods->where('id', $hideOthersRule->getPaymentMethodId());
                }
            }
        }

        // Проверяем все правила для методов оплаты
        $result = collect();
        foreach ($this->paymentMethods as $paymentMethod) {

            // Проверить метод совпал ли с каким-то правилом, если нет, то добавить в результаты
            $matched = false;
            foreach ($this->rulesBuilder->getRules() as $rule) {
                if ($rule->getPaymentMethodId() !== $paymentMethod->id) {
                    continue;
                }
                $matched = $rule->checkCondition($order);
            }
            // TODO: check

            if (!$matched) {
                $result->push($paymentMethod);
            }
        }

        return $result;
    }
}
