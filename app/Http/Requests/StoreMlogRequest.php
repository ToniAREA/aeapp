<?php

namespace App\Http\Requests;

use App\Models\MLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_log_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'max:30',
                'nullable',
            ],
        ];
    }
}
