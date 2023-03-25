<?php

namespace App\Http\Requests;

use App\Models\Wlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWlistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlist_edit');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'boat_id' => [
                'required',
                'integer',
            ],
            'desciption' => [
                'string',
                'min:5',
                'max:200',
                'required',
            ],
            'deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'wlogs.*' => [
                'integer',
            ],
            'wlogs' => [
                'array',
            ],
        ];
    }
}
