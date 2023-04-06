<?php

namespace App\Http\Requests;

use App\Models\BoatsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBoatsTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boats_type_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
