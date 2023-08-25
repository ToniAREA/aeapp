<?php

namespace App\Http\Requests;

use App\Models\ContactTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_tag_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:contact_tags',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
