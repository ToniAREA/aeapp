<?php

namespace App\Http\Requests;

use App\Models\Wlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlog_edit');
    }

    public function rules()
    {
        return [
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'wlist_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
