<?php

namespace App\Http\Requests;

use App\Models\Wlist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWlistRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('wlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:wlists,id',
        ];
    }
}
