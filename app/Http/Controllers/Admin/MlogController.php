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

class MlogController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlogs = Mlog::with(['client', 'boat', 'wlist', 'product', 'tags', 'proforma_number'])->get();

        return view('admin.mlogs.index', compact('mlogs'));
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
