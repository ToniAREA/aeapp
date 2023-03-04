<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWlogRequest;
use App\Http\Requests\StoreWlogRequest;
use App\Http\Requests\UpdateWlogRequest;
use App\Models\Wlist;
use App\Models\Wlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WlogsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('wlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Wlog::with(['wlist'])->select(sprintf('%s.*', (new Wlog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'wlog_show';
                $editGate = 'wlog_edit';
                $deleteGate = 'wlog_delete';
                $crudRoutePart = 'wlogs';

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

            $table->addColumn('wlist_desciption', function ($row) {
                return $row->wlist ? $row->wlist->desciption : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'wlist']);

            return $table->make(true);
        }

        $wlists = Wlist::get();

        return view('admin.wlogs.index', compact('wlists'));
    }

    public function create()
    {
        abort_if(Gate::denies('wlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('desciption', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wlogs.create', compact('wlists'));
    }

    public function store(StoreWlogRequest $request)
    {
        $wlog = Wlog::create($request->all());

        return redirect()->route('admin.wlogs.index');
    }

    public function edit(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('desciption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlog->load('wlist');

        return view('admin.wlogs.edit', compact('wlists', 'wlog'));
    }

    public function update(UpdateWlogRequest $request, Wlog $wlog)
    {
        $wlog->update($request->all());

        return redirect()->route('admin.wlogs.index');
    }

    public function show(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->load('wlist', 'wlogsWlists');

        return view('admin.wlogs.show', compact('wlog'));
    }

    public function destroy(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlogRequest $request)
    {
        Wlog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
