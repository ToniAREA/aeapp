<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class MatLogsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mat_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MatLog::with(['boat', 'wlist', 'employee', 'product', 'proforma_number'])->select(sprintf('%s.*', (new MatLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mat_log_show';
                $editGate      = 'mat_log_edit';
                $deleteGate    = 'mat_log_delete';
                $crudRoutePart = 'mat-logs';

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
            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('boat.internalnotes', function ($row) {
                return $row->boat ? (is_string($row->boat) ? $row->boat : $row->boat->internalnotes) : '';
            });
            $table->editColumn('boat_namecomplete', function ($row) {
                return $row->boat_namecomplete ? $row->boat_namecomplete : '';
            });
            $table->addColumn('wlist_description', function ($row) {
                return $row->wlist ? $row->wlist->description : '';
            });

            $table->editColumn('wlist.status', function ($row) {
                return $row->wlist ? (is_string($row->wlist) ? $row->wlist : $row->wlist->status) : '';
            });

            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('employee.email', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->email) : '';
            });
            $table->editColumn('item', function ($row) {
                return $row->item ? $row->item : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('product.description', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->description) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('pvp', function ($row) {
                return $row->pvp ? $row->pvp : '';
            });
            $table->editColumn('units', function ($row) {
                return $row->units ? $row->units : '';
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

            $table->rawColumns(['actions', 'placeholder', 'boat', 'wlist', 'employee', 'product', 'proforma_number', 'invoiced_line']);

            return $table->make(true);
        }

        return view('admin.matLogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mat_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.matLogs.create', compact('boats', 'employees', 'products', 'proforma_numbers', 'wlists'));
    }

    public function store(StoreMatLogRequest $request)
    {
        $matLog = MatLog::create($request->all());

        return redirect()->route('admin.mat-logs.index');
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

        return view('admin.matLogs.edit', compact('boats', 'employees', 'matLog', 'products', 'proforma_numbers', 'wlists'));
    }

    public function update(UpdateMatLogRequest $request, MatLog $matLog)
    {
        $matLog->update($request->all());

        return redirect()->route('admin.mat-logs.index');
    }

    public function show(MatLog $matLog)
    {
        abort_if(Gate::denies('mat_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $matLog->load('boat', 'wlist', 'employee', 'product', 'proforma_number');

        return view('admin.matLogs.show', compact('matLog'));
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
