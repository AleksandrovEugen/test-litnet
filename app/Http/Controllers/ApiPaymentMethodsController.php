<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Services\PaymentMethodService;
use Illuminate\Http\JsonResponse;

class ApiPaymentMethodsController extends Controller
{
    public function __construct(
        private PaymentMethodService $paymentMethodService,
    )
    {
    }

    public function index(PaymentMethodRequest $request): JsonResponse
    {
        return response()->json($this->paymentMethodService->getButtons(
            $request->validated('productType'),
            $request->validated('amount'),
            $request->validated('lang'),
            $request->validated('countryCode'),
            $request->validated('userOs'),
        ));
    }
}
