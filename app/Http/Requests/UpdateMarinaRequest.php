<?php

namespace App\Http\Requests;

use App\Models\Marina;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMarinaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('marina_edit');
    }

    public function rules()
    {
        return [
            'id_marina' => [
                'string',
                'required',
                'unique:marinas,id_marina,' . request()->route('marina')->id,
            ],
            'name' => [
                'string',
                'required',
                'unique:marinas,name,' . request()->route('marina')->id,
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
