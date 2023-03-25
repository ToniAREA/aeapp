<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWlistRequest;
use App\Http\Requests\StoreWlistRequest;
use App\Http\Requests\UpdateWlistRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Priority;
use App\Models\Wlist;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WlistController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Wlist::with(['client', 'boat', 'priority', 'wlogs'])->select(sprintf('%s.*', (new Wlist)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'wlist_show';
                $editGate      = 'wlist_edit';
                $deleteGate    = 'wlist_delete';
                $crudRoutePart = 'wlists';

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
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('desciption', function ($row) {
                return $row->desciption ? $row->desciption : '';
            });

            $table->addColumn('priority_level', function ($row) {
                return $row->priority ? $row->priority->level : '';
            });

            $table->editColumn('wlogs', function ($row) {
                $labels = [];
                foreach ($row->wlogs as $wlog) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $wlog->date);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'boat', 'priority', 'wlogs']);

            return $table->make(true);
        }

        $clients    = Client::get();
        $boats      = Boat::get();
        $priorities = Priority::get();
        $wlogs      = Wlog::get();

        return view('admin.wlists.index', compact('clients', 'boats', 'priorities', 'wlogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::pluck('level', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlogs = Wlog::pluck('date', 'id');

        return view('admin.wlists.create', compact('boats', 'clients', 'priorities', 'wlogs'));
    }

    public function store(StoreWlistRequest $request)
    {
        $wlist = Wlist::create($request->all());
        $wlist->wlogs()->sync($request->input('wlogs', []));

        return redirect()->route('admin.wlists.index');
    }

    public function edit(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::pluck('level', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlogs = Wlog::pluck('date', 'id');

        $wlist->load('client', 'boat', 'priority', 'wlogs');

        return view('admin.wlists.edit', compact('boats', 'clients', 'priorities', 'wlist', 'wlogs'));
    }

    public function update(UpdateWlistRequest $request, Wlist $wlist)
    {
        $wlist->update($request->all());
        $wlist->wlogs()->sync($request->input('wlogs', []));

        return redirect()->route('admin.wlists.index');
    }

    public function show(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->load('client', 'boat', 'priority', 'wlogs', 'wlistWlogs', 'wlistMlogs');

        return view('admin.wlists.show', compact('wlist'));
    }

    public function destroy(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlistRequest $request)
    {
        $wlists = Wlist::find(request('ids'));

        foreach ($wlists as $wlist) {
            $wlist->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
