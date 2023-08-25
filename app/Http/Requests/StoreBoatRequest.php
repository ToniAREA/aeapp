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
            'ref' => [
                'string',
                'nullable',
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
            'notes' => [
                'string',
                'nullable',
            ],
            'internalnotes' => [
                'string',
                'nullable',
            ],
            'clients.*' => [
                'integer',
            ],
            'clients' => [
                'array',
            ],
            'coordinates' => [
                'string',
                'nullable',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'last_use' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
