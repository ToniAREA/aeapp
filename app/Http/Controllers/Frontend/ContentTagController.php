<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContentTagRequest;
use App\Http\Requests\StoreContentTagRequest;
use App\Http\Requests\UpdateContentTagRequest;
use App\Models\ContentTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('content_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentTags = ContentTag::all();

        return view('frontend.contentTags.index', compact('contentTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.contentTags.create');
    }

    public function store(StoreContentTagRequest $request)
    {
        $contentTag = ContentTag::create($request->all());

        return redirect()->route('frontend.content-tags.index');
    }

    public function edit(ContentTag $contentTag)
    {
        abort_if(Gate::denies('content_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.contentTags.edit', compact('contentTag'));
    }

    public function update(UpdateContentTagRequest $request, ContentTag $contentTag)
    {
        $contentTag->update($request->all());

        return redirect()->route('frontend.content-tags.index');
    }

    public function show(ContentTag $contentTag)
    {
        abort_if(Gate::denies('content_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.contentTags.show', compact('contentTag'));
    }

    public function destroy(ContentTag $contentTag)
    {
        abort_if(Gate::denies('content_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentTagRequest $request)
    {
        $contentTags = ContentTag::find(request('ids'));

        foreach ($contentTags as $contentTag) {
            $contentTag->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
