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
            'id_client' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:clients,id_client',
            ],
            'contacts.*' => [
                'integer',
            ],
            'contacts' => [
                'array',
            ],
            'boats.*' => [
                'integer',
            ],
            'boats' => [
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
            'link' => [
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
