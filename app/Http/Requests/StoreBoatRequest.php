<?php

namespace App\Http\Requests;

use App\Models\Boat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBoatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boat_create');
    }

    public function rules()
    {
        return [
            'id_boat' => [
                'string',
                'required',
                'unique:boats',
            ],
            'name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'clients.*' => [
                'integer',
            ],
            'clients' => [
                'array',
            ],
            'mmsi' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internalnotes' => [
                'string',
                'nullable',
            ],
            'lastuse' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
