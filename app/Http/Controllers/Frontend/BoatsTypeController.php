<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBoatsTypeRequest;
use App\Http\Requests\StoreBoatsTypeRequest;
use App\Http\Requests\UpdateBoatsTypeRequest;
use App\Models\Boat;
use App\Models\BoatsType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoatsTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('boats_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boatsTypes = BoatsType::with(['boats_types'])->get();

        return view('frontend.boatsTypes.index', compact('boatsTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('boats_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats_types = Boat::pluck('type', 'id');

        return view('frontend.boatsTypes.create', compact('boats_types'));
    }

    public function store(StoreBoatsTypeRequest $request)
    {
        $boatsType = BoatsType::create($request->all());
        $boatsType->boats_types()->sync($request->input('boats_types', []));

        return redirect()->route('frontend.boats-types.index');
    }

    public function edit(BoatsType $boatsType)
    {
        abort_if(Gate::denies('boats_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats_types = Boat::pluck('type', 'id');

        $boatsType->load('boats_types');

        return view('frontend.boatsTypes.edit', compact('boatsType', 'boats_types'));
    }

    public function update(UpdateBoatsTypeRequest $request, BoatsType $boatsType)
    {
        $boatsType->update($request->all());
        $boatsType->boats_types()->sync($request->input('boats_types', []));

        return redirect()->route('frontend.boats-types.index');
    }

    public function show(BoatsType $boatsType)
    {
        abort_if(Gate::denies('boats_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boatsType->load('boats_types');

        return view('frontend.boatsTypes.show', compact('boatsType'));
    }

    public function destroy(BoatsType $boatsType)
    {
        abort_if(Gate::denies('boats_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boatsType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoatsTypeRequest $request)
    {
        $boatsTypes = BoatsType::find(request('ids'));

        foreach ($boatsTypes as $boatsType) {
            $boatsType->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
