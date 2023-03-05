<?php

namespace App\Http\Requests;

use App\Models\ToDo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateToDoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('to_do_edit');
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
