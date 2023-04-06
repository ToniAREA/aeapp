<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWlogRequest;
use App\Http\Requests\StoreWlogRequest;
use App\Http\Requests\UpdateWlogRequest;
use App\Models\Marina;
use App\Models\Tag;
use App\Models\User;
use App\Models\Wlist;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WlogsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('wlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlogs = Wlog::with(['wlist', 'employee', 'marina', 'tags'])->get();

        return view('frontend.wlogs.index', compact('wlogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('desciption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        return view('frontend.wlogs.create', compact('employees', 'marinas', 'tags', 'wlists'));
    }

    public function store(StoreWlogRequest $request)
    {
        $wlog = Wlog::create($request->all());
        $wlog->tags()->sync($request->input('tags', []));

        return redirect()->route('frontend.wlogs.index');
    }

    public function edit(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('desciption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        $wlog->load('wlist', 'employee', 'marina', 'tags');

        return view('frontend.wlogs.edit', compact('employees', 'marinas', 'tags', 'wlists', 'wlog'));
    }

    public function update(UpdateWlogRequest $request, Wlog $wlog)
    {
        $wlog->update($request->all());
        $wlog->tags()->sync($request->input('tags', []));

        return redirect()->route('frontend.wlogs.index');
    }

    public function show(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->load('wlist', 'employee', 'marina', 'tags', 'wlogsWlists');

        return view('frontend.wlogs.show', compact('wlog'));
    }

    public function destroy(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlogRequest $request)
    {
        $wlogs = Wlog::find(request('ids'));

        foreach ($wlogs as $wlog) {
            $wlog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
