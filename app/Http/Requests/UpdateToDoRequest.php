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
            'photo' => [
                'array',
            ],
            'deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'priority_id' => [
                'required',
                'integer',
            ],
            'for_roles.*' => [
                'integer',
            ],
            'for_roles' => [
                'array',
            ],
            'for_users.*' => [
                'integer',
            ],
            'for_users' => [
                'array',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
