<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentCategoryRequest;
use App\Http\Requests\StoreContentCategoryRequest;
use App\Http\Requests\UpdateContentCategoryRequest;
use App\Models\ContentCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ContentCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('content_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentCategories = ContentCategory::with(['media'])->get();

        return view('admin.contentCategories.index', compact('contentCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentCategories.create');
    }

    public function store(StoreContentCategoryRequest $request)
    {
        $contentCategory = ContentCategory::create($request->all());

        if ($request->input('photo', false)) {
            $contentCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentCategory->id]);
        }

        return redirect()->route('admin.content-categories.index');
    }

    public function edit(ContentCategory $contentCategory)
    {
        abort_if(Gate::denies('content_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentCategories.edit', compact('contentCategory'));
    }

    public function update(UpdateContentCategoryRequest $request, ContentCategory $contentCategory)
    {
        $contentCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (! $contentCategory->photo || $request->input('photo') !== $contentCategory->photo->file_name) {
                if ($contentCategory->photo) {
                    $contentCategory->photo->delete();
                }
                $contentCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($contentCategory->photo) {
            $contentCategory->photo->delete();
        }

        return redirect()->route('admin.content-categories.index');
    }

    public function show(ContentCategory $contentCategory)
    {
        abort_if(Gate::denies('content_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentCategories.show', compact('contentCategory'));
    }

    public function destroy(ContentCategory $contentCategory)
    {
        abort_if(Gate::denies('content_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentCategoryRequest $request)
    {
        $contentCategories = ContentCategory::find(request('ids'));

        foreach ($contentCategories as $contentCategory) {
            $contentCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_category_create') && Gate::denies('content_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
