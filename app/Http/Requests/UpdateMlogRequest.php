<?php

namespace App\Http\Requests;

use App\Models\Mlog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mlog_edit');
    }

    public function rules()
    {
        return [
            'id_mlog' => [
                'string',
                'nullable',
            ],
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
