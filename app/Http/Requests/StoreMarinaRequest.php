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
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
            'link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
