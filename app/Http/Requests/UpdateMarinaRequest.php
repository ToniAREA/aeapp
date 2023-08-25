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
            'name' => [
                'string',
                'required',
                'unique:marinas,name,' . request()->route('marina')->id,
            ],
            'coordinates' => [
                'string',
                'nullable',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
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
