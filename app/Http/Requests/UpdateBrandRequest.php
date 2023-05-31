<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBrandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('brand_edit');
    }

    public function rules()
    {
        return [
            'brand' => [
                'string',
                'required',
                'unique:brands,brand,' . request()->route('brand')->id,
            ],
            'brand_url' => [
                'string',
                'nullable',
            ],
            'providers.*' => [
                'integer',
            ],
            'providers' => [
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
