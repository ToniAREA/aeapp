<?php

namespace App\Http\Requests;

use App\Models\Wlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWlistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlist_create');
    }

    public function rules()
    {
        return [
            'desciption' => [
                'string',
                'min:5',
                'max:200',
                'required',
            ],
            'wlogs.*' => [
                'integer',
            ],
            'wlogs' => [
                'array',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'boat_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
