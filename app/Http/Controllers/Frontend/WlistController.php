<?php

namespace App\Http\Controllers\Frontend;

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

class WlistController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::with(['client', 'boat', 'priority', 'wlogs'])->get();

        $clients = Client::get();

        $boats = Boat::get();

        $priorities = Priority::get();

        $wlogs = Wlog::get();

        return view('frontend.wlists.index', compact('boats', 'clients', 'priorities', 'wlists', 'wlogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::pluck('level', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlogs = Wlog::pluck('date', 'id');

        return view('frontend.wlists.create', compact('boats', 'clients', 'priorities', 'wlogs'));
    }

    public function store(StoreWlistRequest $request)
    {
        $wlist = Wlist::create($request->all());
        $wlist->wlogs()->sync($request->input('wlogs', []));

        return redirect()->route('frontend.wlists.index');
    }

    public function edit(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $priorities = Priority::pluck('level', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlogs = Wlog::pluck('date', 'id');

        $wlist->load('client', 'boat', 'priority', 'wlogs');

        return view('frontend.wlists.edit', compact('boats', 'clients', 'priorities', 'wlist', 'wlogs'));
    }

    public function update(UpdateWlistRequest $request, Wlist $wlist)
    {
        $wlist->update($request->all());
        $wlist->wlogs()->sync($request->input('wlogs', []));

        return redirect()->route('frontend.wlists.index');
    }

    public function show(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->load('client', 'boat', 'priority', 'wlogs', 'wlistWlogs', 'wlistMlogs');

        return view('frontend.wlists.show', compact('wlist'));
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
