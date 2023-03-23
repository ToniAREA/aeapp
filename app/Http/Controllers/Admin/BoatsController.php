<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBoatRequest;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
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
            $query = Boat::query()->select(sprintf('%s.*', (new Boat)->table));
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
            $table->editColumn('id_boat', function ($row) {
                return $row->id_boat ? $row->id_boat : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('mmsi', function ($row) {
                return $row->mmsi ? $row->mmsi : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internalnotes', function ($row) {
                return $row->internalnotes ? $row->internalnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.boats.index');
    }

    public function create()
    {
        abort_if(Gate::denies('boat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.boats.create');
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());

        return redirect()->route('admin.boats.index');
    }

    public function edit(Boat $boat)
    {
        abort_if(Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.boats.edit', compact('boat'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());

        return redirect()->route('admin.boats.index');
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->load('boatWlists', 'boatsClients', 'boatsMarinas');

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
