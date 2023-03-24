<?php

namespace App\Http\Requests;

use App\Models\ContactContact;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactContactRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_contact_edit');
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
            'contact_email' => [
                'string',
                'nullable',
            ],
            'contact_mobile' => [
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
