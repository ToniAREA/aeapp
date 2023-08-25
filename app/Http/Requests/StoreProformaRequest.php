<?php

namespace App\Http\Requests;

use App\Models\Proforma;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProformaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('proforma_create');
    }

    public function rules()
    {
        return [
            'proforma_number' => [
                'string',
                'required',
                'unique:proformas',
            ],
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'array',
            ],
            'wlists.*' => [
                'integer',
            ],
            'wlists' => [
                'array',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'description' => [
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
            'claims' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
