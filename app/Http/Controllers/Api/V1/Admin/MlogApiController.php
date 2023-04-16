<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Http\Resources\Admin\MlogResource;
use App\Models\Mlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MlogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MlogResource(Mlog::with(['client', 'boat', 'wlist', 'product', 'tags', 'proforma_number'])->get());
    }

    public function store(StoreMlogRequest $request)
    {
        $mlog = Mlog::create($request->all());
        $mlog->tags()->sync($request->input('tags', []));

        return (new MlogResource($mlog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MlogResource($mlog->load(['client', 'boat', 'wlist', 'product', 'tags', 'proforma_number']));
    }

    public function update(UpdateMlogRequest $request, Mlog $mlog)
    {
        $mlog->update($request->all());
        $mlog->tags()->sync($request->input('tags', []));

        return (new MlogResource($mlog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
