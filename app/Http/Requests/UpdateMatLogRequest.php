<?php

namespace App\Http\Requests;

use App\Models\MatLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMatLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mat_log_edit');
    }

    public function rules()
    {
        return [
            'boat_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'employee_id' => [
                'required',
                'integer',
            ],
            'item' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'pvp' => [
                'numeric',
            ],
            'units' => [
                'numeric',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
