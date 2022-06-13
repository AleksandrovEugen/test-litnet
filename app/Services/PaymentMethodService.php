<?php

namespace App\Services;

use App\DTO\Order;
use App\Filters\FilterBuilder;
use App\Filters\PaymentMethodFilter;
use App\Filters\RulesBuilder;
use App\Models\PaymentGateway;
use App\Models\PaymentMethod;
use Illuminate\Support\Collection;

class PaymentMethodService
{
    public function getButtons(
        string $productType,
        float $amount,
        string $lang,
        string $countryCode,
        string $userOs
    ): Collection
    {
        $order = new Order($productType, $amount, $lang, $countryCode, $userOs);

        $paymentGateways = PaymentGateway::enabled()->get();
        $paymentMethods = PaymentMethod::enabled()
            ->whereBelongsTo($paymentGateways)
            ->orderBy('id') // TODO: replace to sort_order
            ->get();

        $rulesBuilder = new RulesBuilder();
        $rulesBuilder->build(config('rules'));

        $paymentMethodFilter = new PaymentMethodFilter($rulesBuilder, $paymentMethods);

        return $paymentMethodFilter->filter($order);
    }
}
