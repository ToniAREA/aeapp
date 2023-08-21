<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBoatRequest;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
use App\Models\Client;
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

        $boats = Boat::with(['marina', 'clients'])->get();

        $marinas = Marina::get();

        $clients = Client::get();

        return view('frontend.boats.index', compact('boats', 'clients', 'marinas'));
    }

    public function create()
    {
        abort_if(Gate::denies('boat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id');

        return view('frontend.boats.create', compact('clients', 'marinas'));
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());
        $boat->clients()->sync($request->input('clients', []));

        return redirect()->route('frontend.boats.index');
    }

    public function edit(Boat $boat)
    {
        abort_if(Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id');

        $boat->load('marina', 'clients');

        return view('frontend.boats.edit', compact('boat', 'clients', 'marinas'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());
        $boat->clients()->sync($request->input('clients', []));

        return redirect()->route('frontend.boats.index');
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->load('marina', 'clients', 'boatWlists', 'boatAppointments', 'boatMatLogs', 'boatsClients', 'boatsProformas');

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
