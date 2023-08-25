<?php

namespace App\Http\Requests;

use App\Models\Priority;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePriorityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('priority_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:priorities',
            ],
            'weight' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
