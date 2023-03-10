<?php

namespace App\Http\Requests;

use App\Models\Marina;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMarinaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('marina_create');
    }

    public function rules()
    {
        return [
            'id_marina' => [
                'string',
                'required',
                'unique:marinas',
            ],
            'name' => [
                'string',
                'required',
                'unique:marinas',
            ],
            'coordinates' => [
                'string',
                'nullable',
            ],
            'lastuse' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'array',
            ],
        ];
    }
}
