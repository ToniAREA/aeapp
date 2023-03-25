<?php

namespace App\Http\Requests;

use App\Models\BoatsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoatsTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boats_type_create');
    }

    public function rules()
    {
        return [
            'boats_types.*' => [
                'integer',
            ],
            'boats_types' => [
                'array',
            ],
        ];
    }
}
