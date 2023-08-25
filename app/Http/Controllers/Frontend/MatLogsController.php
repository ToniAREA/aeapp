<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMatLogRequest;
use App\Http\Requests\StoreMatLogRequest;
use App\Http\Requests\UpdateMatLogRequest;
use App\Models\Boat;
use App\Models\MatLog;
use App\Models\Product;
use App\Models\Proforma;
use App\Models\User;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MatLogsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('mat_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matLogs = MatLog::with(['boat', 'wlist', 'employee', 'product', 'proforma_number'])->get();

        return view('frontend.matLogs.index', compact('matLogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('mat_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.matLogs.create', compact('boats', 'employees', 'products', 'proforma_numbers', 'wlists'));
    }

    public function store(StoreMatLogRequest $request)
    {
        $matLog = MatLog::create($request->all());

        return redirect()->route('frontend.mat-logs.index');
    }

    public function edit(MatLog $matLog)
    {
        abort_if(Gate::denies('mat_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $matLog->load('boat', 'wlist', 'employee', 'product', 'proforma_number');

        return view('frontend.matLogs.edit', compact('boats', 'employees', 'matLog', 'products', 'proforma_numbers', 'wlists'));
    }

    public function update(UpdateMatLogRequest $request, MatLog $matLog)
    {
        $matLog->update($request->all());

        return redirect()->route('frontend.mat-logs.index');
    }

    public function show(MatLog $matLog)
    {
        abort_if(Gate::denies('mat_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matLog->load('boat', 'wlist', 'employee', 'product', 'proforma_number');

        return view('frontend.matLogs.show', compact('matLog'));
    }

    public function destroy(MatLog $matLog)
    {
        abort_if(Gate::denies('mat_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyMatLogRequest $request)
    {
        $matLogs = MatLog::find(request('ids'));

        foreach ($matLogs as $matLog) {
            $matLog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
