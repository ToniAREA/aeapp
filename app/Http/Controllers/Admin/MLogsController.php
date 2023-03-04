<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMLogRequest;
use App\Http\Requests\StoreMLogRequest;
use App\Http\Requests\UpdateMLogRequest;
use App\Models\MLog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MLogsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('m_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mLogs = MLog::all();

        return view('admin.mLogs.index', compact('mLogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('m_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mLogs.create');
    }

    public function store(StoreMLogRequest $request)
    {
        $mLog = MLog::create($request->all());

        return redirect()->route('admin.m-logs.index');
    }

    public function edit(MLog $mLog)
    {
        abort_if(Gate::denies('m_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mLogs.edit', compact('mLog'));
    }

    public function update(UpdateMLogRequest $request, MLog $mLog)
    {
        $mLog->update($request->all());

        return redirect()->route('admin.m-logs.index');
    }

    public function show(MLog $mLog)
    {
        abort_if(Gate::denies('m_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.mLogs.show', compact('mLog'));
    }

    public function destroy(MLog $mLog)
    {
        abort_if(Gate::denies('m_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyMLogRequest $request)
    {
        $mLogs = MLog::find(request('ids'));

        foreach ($mLogs as $mLog) {
            $mLog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
