<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMlogRequest;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Models\Mlog;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MlogsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mlog::with(['wlist'])->select(sprintf('%s.*', (new Mlog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mlog_show';
                $editGate      = 'mlog_edit';
                $deleteGate    = 'mlog_delete';
                $crudRoutePart = 'mlogs';

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
            $table->editColumn('id_mlog', function ($row) {
                return $row->id_mlog ? $row->id_mlog : '';
            });

            $table->addColumn('wlist_desciption', function ($row) {
                return $row->wlist ? $row->wlist->desciption : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'wlist']);

            return $table->make(true);
        }

        $wlists = Wlist::get();

        return view('admin.mlogs.index', compact('wlists'));
    }

    public function create()
    {
        abort_if(Gate::denies('mlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('desciption', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mlogs.create', compact('wlists'));
    }

    public function store(StoreMlogRequest $request)
    {
        $mlog = Mlog::create($request->all());

        return redirect()->route('admin.mlogs.index');
    }

    public function edit(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('desciption', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mlog->load('wlist');

        return view('admin.mlogs.edit', compact('mlog', 'wlists'));
    }

    public function update(UpdateMlogRequest $request, Mlog $mlog)
    {
        $mlog->update($request->all());

        return redirect()->route('admin.mlogs.index');
    }

    public function show(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->load('wlist');

        return view('admin.mlogs.show', compact('mlog'));
    }

    public function destroy(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyMlogRequest $request)
    {
        $mlogs = Mlog::find(request('ids'));

        foreach ($mlogs as $mlog) {
            $mlog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
