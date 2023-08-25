<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMarinaRequest;
use App\Http\Requests\StoreMarinaRequest;
use App\Http\Requests\UpdateMarinaRequest;
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
            $query = Marina::query()->select(sprintf('%s.*', (new Marina)->table));
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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.marinas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('marina_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.marinas.create');
    }

    public function store(StoreMarinaRequest $request)
    {
        $marina = Marina::create($request->all());

        return redirect()->route('admin.marinas.index');
    }

    public function edit(Marina $marina)
    {
        abort_if(Gate::denies('marina_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.marinas.edit', compact('marina'));
    }

    public function update(UpdateMarinaRequest $request, Marina $marina)
    {
        $marina->update($request->all());

        return redirect()->route('admin.marinas.index');
    }

    public function show(Marina $marina)
    {
        abort_if(Gate::denies('marina_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marina->load('marinaBoats', 'marinaWlogs');

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
