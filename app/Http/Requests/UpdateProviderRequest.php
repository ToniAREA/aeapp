<?php

namespace App\Http\Requests;

use App\Models\Provider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProviderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('provider_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'brands.*' => [
                'integer',
            ],
            'brands' => [
                'array',
            ],
            'price_list' => [
                'array',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
