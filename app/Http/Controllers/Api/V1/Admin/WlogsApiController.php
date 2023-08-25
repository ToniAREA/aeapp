<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWlogRequest;
use App\Http\Requests\UpdateWlogRequest;
use App\Http\Resources\Admin\WlogResource;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WlogsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlogResource(Wlog::with(['wlist', 'employee', 'marina', 'proforma_number'])->get());
    }

    public function store(StoreWlogRequest $request)
    {
        $wlog = Wlog::create($request->all());

        return (new WlogResource($wlog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WlogResource($wlog->load(['wlist', 'employee', 'marina', 'proforma_number']));
    }

    public function update(UpdateWlogRequest $request, Wlog $wlog)
    {
        $wlog->update($request->all());

        return (new WlogResource($wlog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
