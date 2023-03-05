<?php

namespace App\Http\Requests;

use App\Models\ToDo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreToDoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('to_do_create');
    }

    public function rules()
    {
        return [
            'task' => [
                'string',
                'max:200',
                'nullable',
            ],
        ];
    }
}
