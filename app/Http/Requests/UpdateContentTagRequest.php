<?php

namespace App\Http\Requests;

use App\Models\ContentTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContentTagRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_tag_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:content_tags,name,' . request()->route('content_tag')->id,
            ],
            'slug' => [
                'string',
                'nullable',
            ],
        ];
    }
}
