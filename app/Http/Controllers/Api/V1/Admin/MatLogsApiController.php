<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMatLogRequest;
use App\Http\Requests\UpdateMatLogRequest;
use App\Http\Resources\Admin\MatLogResource;
use App\Models\MatLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatLogsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mat_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MatLogResource(MatLog::with(['boat', 'wlist', 'employee', 'product', 'proforma_number'])->get());
    }

    public function store(StoreMatLogRequest $request)
    {
        $matLog = MatLog::create($request->all());

        return (new MatLogResource($matLog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MatLog $matLog)
    {
        abort_if(Gate::denies('mat_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MatLogResource($matLog->load(['boat', 'wlist', 'employee', 'product', 'proforma_number']));
    }

    public function update(UpdateMatLogRequest $request, MatLog $matLog)
    {
        $matLog->update($request->all());

        return (new MatLogResource($matLog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MatLog $matLog)
    {
        abort_if(Gate::denies('mat_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matLog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
