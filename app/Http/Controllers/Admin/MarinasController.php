<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMarinaRequest;
use App\Http\Requests\StoreMarinaRequest;
use App\Http\Requests\UpdateMarinaRequest;
use App\Models\Boat;
use App\Models\Marina;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MarinasController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('marina_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Marina::with(['boats'])->select(sprintf('%s.*', (new Marina)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'marina_show';
                $editGate      = 'marina_edit';
                $deleteGate    = 'marina_delete';
                $crudRoutePart = 'marinas';

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
            $table->editColumn('id_marina', function ($row) {
                return $row->id_marina ? $row->id_marina : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
            });

            $table->editColumn('boats', function ($row) {
                $labels = [];
                foreach ($row->boats as $boat) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $boat->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'boats']);

            return $table->make(true);
        }

        $boats = Boat::get();

        return view('admin.marinas.index', compact('boats'));
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

        $marina->load('boats', 'marinaBoats');

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
