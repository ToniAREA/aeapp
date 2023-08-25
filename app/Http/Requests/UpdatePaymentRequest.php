<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_edit');
    }

    public function rules()
    {
        return [
            'payment_gateway' => [
                'string',
                'nullable',
            ],
            'id_transaction' => [
                'string',
                'nullable',
            ],
            'total_amount' => [
                'numeric',
            ],
            'currency' => [
                'string',
                'max:3',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
