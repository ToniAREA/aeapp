<?php

namespace App\Http\Requests;

use App\Models\ContactContact;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactContactRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_contact_create');
    }

    public function rules()
    {
        return [
            'contact_first_name' => [
                'string',
                'nullable',
            ],
            'contact_last_name' => [
                'string',
                'nullable',
            ],
            'contact_nif' => [
                'string',
                'nullable',
            ],
            'contact_address' => [
                'string',
                'nullable',
            ],
            'contact_country' => [
                'string',
                'nullable',
            ],
            'contact_mobile' => [
                'string',
                'nullable',
            ],
            'contact_mobile_2' => [
                'string',
                'nullable',
            ],
            'contact_email' => [
                'string',
                'nullable',
            ],
            'contact_email_2' => [
                'string',
                'nullable',
            ],
            'social_link' => [
                'string',
                'nullable',
            ],
            'contact_tags' => [
                'string',
                'nullable',
            ],
            'contact_notes' => [
                'string',
                'nullable',
            ],
            'contact_internalnotes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
