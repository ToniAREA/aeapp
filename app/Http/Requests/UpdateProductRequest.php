<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'model' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'required',
            ],
            'product_slug' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
            'price' => [
                'required',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'file' => [
                'array',
            ],
        ];
    }
}
