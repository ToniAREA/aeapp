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
            'level' => [
                'string',
                'max:10',
                'nullable',
            ],
        ];
    }
}
