<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\Country;
use App\Models\Lang;
use App\Models\ProductType;
use App\Services\PaymentMethodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
