<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;


class PaymentMethodRequest extends FormRequest
{
    public function wantsJson()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'productType' => ['required', 'string', Rule::exists('product_types', 'code')],
            'amount'      => ['required', 'numeric', 'gt:0'],
            'lang'        => ['required', 'string', Rule::exists('langs', 'code')],
            'countryCode' => ['required', 'string', Rule::exists('countries', 'code')],
            'userOs'      => ['required', 'string', Rule::in(['android', 'ios', 'windows'])]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
