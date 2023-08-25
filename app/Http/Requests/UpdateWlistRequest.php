<?php

namespace App\Http\Requests;

use App\Models\Wlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWlistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wlist_edit');
    }

    public function rules()
    {
        return [
            'boat_id' => [
                'required',
                'integer',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
            'deadline' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'priority' => [
                'string',
                'nullable',
            ],
            'for_roles.*' => [
                'integer',
            ],
            'for_roles' => [
                'array',
            ],
            'for_users.*' => [
                'integer',
            ],
            'for_users' => [
                'array',
            ],
            'status' => [
                'string',
                'nullable',
            ],
            'url_invoice' => [
                'string',
                'nullable',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
