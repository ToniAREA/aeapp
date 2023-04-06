<?php

namespace App\Http\Requests;

use App\Models\Mlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mlog_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'string',
                'nullable',
            ],
            'quantity' => [
                'numeric',
            ],
            'price_unit' => [
                'numeric',
            ],
            'discount' => [
                'numeric',
            ],
            'total' => [
                'numeric',
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
        ];
    }
}
