<?php

namespace App\Http\Requests;

use App\Models\Priority;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePriorityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('priority_edit');
    }

    public function rules()
    {
        return [
            'level' => [
                'string',
                'max:10',
                'nullable',
            ],
            'weight' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
