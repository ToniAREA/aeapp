<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWlogRequest;
use App\Http\Requests\StoreWlogRequest;
use App\Http\Requests\UpdateWlogRequest;
use App\Models\Marina;
use App\Models\Proforma;
use App\Models\User;
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
            $query = Wlog::with(['wlist', 'employee', 'marina', 'proforma_number'])->select(sprintf('%s.*', (new Wlog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'wlog_show';
                $editGate      = 'wlog_edit';
                $deleteGate    = 'wlog_delete';
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
            $table->addColumn('wlist_description', function ($row) {
                return $row->wlist ? $row->wlist->description : '';
            });

            $table->editColumn('wlist.status', function ($row) {
                return $row->wlist ? (is_string($row->wlist) ? $row->wlist : $row->wlist->status) : '';
            });
            $table->editColumn('boat_namecomplete', function ($row) {
                return $row->boat_namecomplete ? $row->boat_namecomplete : '';
            });

            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('employee.email', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->email) : '';
            });
            $table->addColumn('marina_name', function ($row) {
                return $row->marina ? $row->marina->name : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('hours', function ($row) {
                return $row->hours ? $row->hours : '';
            });
            $table->addColumn('proforma_number_proforma_number', function ($row) {
                return $row->proforma_number ? $row->proforma_number->proforma_number : '';
            });

            $table->editColumn('proforma_number.description', function ($row) {
                return $row->proforma_number ? (is_string($row->proforma_number) ? $row->proforma_number : $row->proforma_number->description) : '';
            });
            $table->editColumn('invoiced_line', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->invoiced_line ? 'checked' : null) . '>';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'wlist', 'employee', 'marina', 'proforma_number', 'invoiced_line']);

            return $table->make(true);
        }

        return view('admin.wlogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('wlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wlogs.create', compact('employees', 'marinas', 'proforma_numbers', 'wlists'));
    }

    public function store(StoreWlogRequest $request)
    {
        $wlog = Wlog::create($request->all());

        return redirect()->route('admin.wlogs.index');
    }

    public function edit(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $marinas = Marina::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlog->load('wlist', 'employee', 'marina', 'proforma_number');

        return view('admin.wlogs.edit', compact('employees', 'marinas', 'proforma_numbers', 'wlists', 'wlog'));
    }

    public function update(UpdateWlogRequest $request, Wlog $wlog)
    {
        $wlog->update($request->all());

        return redirect()->route('admin.wlogs.index');
    }

    public function show(Wlog $wlog)
    {
        abort_if(Gate::denies('wlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlog->load('wlist', 'employee', 'marina', 'proforma_number');

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
        $wlogs = Wlog::find(request('ids'));

        foreach ($wlogs as $wlog) {
            $wlog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
