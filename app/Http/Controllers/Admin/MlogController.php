<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMlogRequest;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Models\Mlog;
use App\Models\Product;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MlogController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlogs = Mlog::with(['product', 'tags'])->get();

        return view('admin.mlogs.index', compact('mlogs'));
    }

    public function create()
    {
        abort_if(Gate::denies('mlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        return view('admin.mlogs.create', compact('products', 'tags'));
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

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = Tag::pluck('name', 'id');

        $mlog->load('product', 'tags');

        return view('admin.mlogs.edit', compact('mlog', 'products', 'tags'));
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

        $mlog->load('product', 'tags');

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
