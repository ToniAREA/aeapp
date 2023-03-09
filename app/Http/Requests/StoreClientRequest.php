<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:4',
                'max:50',
                'required',
            ],
            'lastname' => [
                'string',
                'nullable',
            ],
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'array',
            ],
            'vat' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'country' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'mobile' => [
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
            'lastuse' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'link_fd' => [
                'string',
                'nullable',
            ],
            'coordinates' => [
                'string',
                'nullable',
            ],
        ];
    }
}
