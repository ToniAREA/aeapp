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
            'type' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'min:1',
                'max:50',
                'required',
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
            'lastuse' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
