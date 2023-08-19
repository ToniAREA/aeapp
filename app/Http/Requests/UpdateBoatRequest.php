<?php

namespace App\Http\Requests;

use App\Models\Boat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBoatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boat_edit');
    }

    public function rules()
    {
        return [
            'id_boat' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:boats,id_boat,' . request()->route('boat')->id,
            ],
            'boat_type' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'imo' => [
                'string',
                'nullable',
            ],
            'mmsi' => [
                'string',
                'nullable',
            ],
            'clients.*' => [
                'integer',
            ],
            'clients' => [
                'array',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internalnotes' => [
                'string',
                'nullable',
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
