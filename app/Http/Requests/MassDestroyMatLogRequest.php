<?php

namespace App\Http\Requests;

use App\Models\MatLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMatLogRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mat_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mat_logs,id',
        ];
    }
}
