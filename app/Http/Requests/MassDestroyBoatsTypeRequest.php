<?php

namespace App\Http\Requests;

use App\Models\BoatsType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBoatsTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('boats_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:boats_types,id',
        ];
    }
}
