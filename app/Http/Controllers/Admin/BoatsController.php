<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BoatsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('boat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Boat::with(['marina', 'clients'])->select(sprintf('%s.*', (new Boat)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'boat_show';
                $editGate      = 'boat_edit';
                $deleteGate    = 'boat_delete';
                $crudRoutePart = 'boats';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : '';
            });
            $table->editColumn('boat_type', function ($row) {
                return $row->boat_type ? $row->boat_type : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('imo', function ($row) {
                return $row->imo ? $row->imo : '';
            });
            $table->editColumn('mmsi', function ($row) {
                return $row->mmsi ? $row->mmsi : '';
            });
            $table->addColumn('marina_name', function ($row) {
                return $row->marina ? $row->marina->name : '';
            });

            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internalnotes', function ($row) {
                return $row->internalnotes ? $row->internalnotes : '';
            });
            $table->editColumn('clients', function ($row) {
                $labels = [];
                foreach ($row->clients as $client) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $client->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'marina', 'clients']);

            return $table->make(true);
        }

        $marinas = Marina::get();
        $clients = Client::get();

        return view('admin.boats.index', compact('marinas', 'clients'));
    }

    public function create()
    {
        abort_if(Gate::denies('boat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id');

        return view('admin.boats.create', compact('clients', 'marinas'));
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());
        $boat->clients()->sync($request->input('clients', []));

        return redirect()->route('admin.boats.index');
    }

    public function edit(Boat $boat)
    {
        abort_if(Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id');

        $boat->load('marina', 'clients');

        return view('admin.boats.edit', compact('boat', 'clients', 'marinas'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());
        $boat->clients()->sync($request->input('clients', []));

        return redirect()->route('admin.boats.index');
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->load('marina', 'clients', 'boatWlists', 'boatAppointments', 'boatMatLogs', 'boatsClients', 'boatsProformas');

        return view('admin.boats.show', compact('boat'));
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
