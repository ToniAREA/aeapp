<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMarinaRequest;
use App\Http\Requests\StoreMarinaRequest;
use App\Http\Requests\UpdateMarinaRequest;
use App\Models\Boat;
use App\Models\Marina;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarinasController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('marina_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::with(['boats'])->get();

        return view('admin.marinas.index', compact('marinas'));
    }

    public function create()
    {
        abort_if(Gate::denies('marina_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        return view('admin.marinas.create', compact('boats'));
    }

    public function store(StoreMarinaRequest $request)
    {
        $marina = Marina::create($request->all());
        $marina->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.marinas.index');
    }

    public function edit(Marina $marina)
    {
        abort_if(Gate::denies('marina_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id');

        $marina->load('boats');

        return view('admin.marinas.edit', compact('boats', 'marina'));
    }

    public function update(UpdateMarinaRequest $request, Marina $marina)
    {
        $marina->update($request->all());
        $marina->boats()->sync($request->input('boats', []));

        return redirect()->route('admin.marinas.index');
    }

    public function show(Marina $marina)
    {
        abort_if(Gate::denies('marina_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->load('boats', 'marinaBoats', 'marinaWlogs');

        return view('admin.marinas.show', compact('marina'));
    }

    public function destroy(Marina $marina)
    {
        abort_if(Gate::denies('marina_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->delete();

        return back();
    }

    public function massDestroy(MassDestroyMarinaRequest $request)
    {
        $marinas = Marina::find(request('ids'));

        foreach ($marinas as $marina) {
            $marina->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
