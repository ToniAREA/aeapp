<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWlistRequest;
use App\Http\Requests\StoreWlistRequest;
use App\Http\Requests\UpdateWlistRequest;
use App\Models\Boat;
use App\Models\Client;
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
            $query = Wlist::with(['wlogs', 'client', 'boat'])->select(sprintf('%s.*', (new Wlist())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'wlist_show';
                $editGate = 'wlist_edit';
                $deleteGate = 'wlist_delete';
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
            $table->editColumn('desciption', function ($row) {
                return $row->desciption ? $row->desciption : '';
            });
            $table->editColumn('wlogs', function ($row) {
                $labels = [];
                foreach ($row->wlogs as $wlog) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $wlog->date);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'wlogs', 'client', 'boat']);

            return $table->make(true);
        }

        $wlogs   = Wlog::get();
        $clients = Client::get();
        $boats   = Boat::get();

        return view('admin.wlists.index', compact('wlogs', 'clients', 'boats'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlogs = Wlog::pluck('date', 'id');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wlists.create', compact('boats', 'clients', 'wlogs'));
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

        $wlogs = Wlog::pluck('date', 'id');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlist->load('wlogs', 'client', 'boat');

        return view('admin.wlists.edit', compact('boats', 'clients', 'wlist', 'wlogs'));
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

        $wlist->load('wlogs', 'client', 'boat', 'wlistWlogs');

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
        Wlist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
