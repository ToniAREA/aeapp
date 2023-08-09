<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMlogRequest;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Mlog;
use App\Models\Product;
use App\Models\Proforma;
use App\Models\Tag;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MlogController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mlog::with(['client', 'boat', 'wlist', 'product', 'tags', 'proforma_number'])->select(sprintf('%s.*', (new Mlog)->table));
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
            $table->addColumn('client_id_client', function ($row) {
                return $row->client ? $row->client->id_client : '';
            });

            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->addColumn('wlist_description', function ($row) {
                return $row->wlist ? $row->wlist->description : '';
            });

            $table->editColumn('wlist.status', function ($row) {
                return $row->wlist ? (is_string($row->wlist) ? $row->wlist : $row->wlist->status) : '';
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
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->editColumn('price_unit', function ($row) {
                return $row->price_unit ? $row->price_unit : '';
            });
            $table->editColumn('discount', function ($row) {
                return $row->discount ? $row->discount : '';
            });
            $table->editColumn('total', function ($row) {
                return $row->total ? $row->total : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('tags', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
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

            $table->rawColumns(['actions', 'placeholder', 'client', 'boat', 'wlist', 'product', 'tags', 'proforma_number', 'invoiced_line']);

            return $table->make(true);
        }

        return view('admin.mlogs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('mlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('id_client', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mlogs.create', compact('boats', 'clients', 'products', 'proforma_numbers', 'tags', 'wlists'));
    }

    public function store(StoreMlogRequest $request)
    {
        $mlog = Mlog::create($request->all());
        $mlog->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.mlogs.index');
    }

    public function edit(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('id_client', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        $proforma_numbers = Proforma::pluck('proforma_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mlog->load('client', 'boat', 'wlist', 'product', 'tags', 'proforma_number');

        return view('admin.mlogs.edit', compact('boats', 'clients', 'mlog', 'products', 'proforma_numbers', 'tags', 'wlists'));
    }

    public function update(UpdateMlogRequest $request, Mlog $mlog)
    {
        $mlog->update($request->all());
        $mlog->tags()->sync($request->input('tags', []));

        return redirect()->route('admin.mlogs.index');
    }

    public function show(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->load('client', 'boat', 'wlist', 'product', 'tags', 'proforma_number');

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
