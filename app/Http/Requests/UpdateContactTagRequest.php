<?php

namespace App\Http\Requests;

use App\Models\ContactTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_tag_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:contact_tags,name,' . request()->route('contact_tag')->id,
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
