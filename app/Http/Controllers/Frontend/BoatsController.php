<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBoatRequest;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
use App\Models\Marina;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoatsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('boat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::with(['marina'])->get();

        $marinas = Marina::get();

        return view('frontend.boats.index', compact('boats', 'marinas'));
    }

    public function create()
    {
        abort_if(Gate::denies('boat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.boats.create', compact('marinas'));
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());

        return redirect()->route('frontend.boats.index');
    }

    public function edit(Boat $boat)
    {
        abort_if(Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boat->load('marina');

        return view('frontend.boats.edit', compact('boat', 'marinas'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());

        return redirect()->route('frontend.boats.index');
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->load('marina', 'boatWlists', 'boatAppointments', 'boatMatLogs', 'boatsClients', 'boatsProformas');

        return view('frontend.boats.show', compact('boat'));
    }

    public function destroy(Boat $boat)
    {
        abort_if(Gate::denies('boat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoatRequest $request)
    {
        $boats = Boat::find(request('ids'));

        foreach ($boats as $boat) {
            $boat->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
