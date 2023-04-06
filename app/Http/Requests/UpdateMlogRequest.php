<?php

namespace App\Http\Requests;

use App\Models\MLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('m_log_edit');
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
