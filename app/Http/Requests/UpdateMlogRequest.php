<?php

namespace App\Http\Requests;

use App\Models\Mlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mlog_edit');
    }

    public function rules()
    {
        return [
            'id_mlog' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
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
