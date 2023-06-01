<?php

namespace App\Http\Requests;

use App\Models\Provider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProviderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('provider_create');
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
            'price_lists' => [
                'array',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
