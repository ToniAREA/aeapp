<?php

namespace App\Http\Requests;

use App\Models\Proforma;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProformaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('proforma_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'proforma_number' => [
                'string',
                'required',
                'unique:proformas,proforma_number,' . request()->route('proforma')->id,
            ],
            'wlists.*' => [
                'integer',
            ],
            'wlists' => [
                'array',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'total_amount' => [
                'numeric',
            ],
            'claims' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
