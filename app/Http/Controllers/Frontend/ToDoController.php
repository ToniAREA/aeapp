<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyToDoRequest;
use App\Http\Requests\StoreToDoRequest;
use App\Http\Requests\UpdateToDoRequest;
use App\Models\Priority;
use App\Models\Role;
use App\Models\ToDo;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ToDoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('to_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDos = ToDo::with(['for_roles', 'for_users', 'priority', 'media'])->get();

        return view('frontend.toDos.index', compact('toDos'));
    }

    public function create()
    {
        abort_if(Gate::denies('to_do_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.toDos.create', compact('for_roles', 'for_users', 'priorities'));
    }

    public function store(StoreToDoRequest $request)
    {
        $toDo = ToDo::create($request->all());
        $toDo->for_roles()->sync($request->input('for_roles', []));
        $toDo->for_users()->sync($request->input('for_users', []));
        foreach ($request->input('photo', []) as $file) {
            $toDo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $toDo->id]);
        }

        return redirect()->route('frontend.to-dos.index');
    }

    public function edit(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $toDo->load('for_roles', 'for_users', 'priority');

        return view('frontend.toDos.edit', compact('for_roles', 'for_users', 'priorities', 'toDo'));
    }

    public function update(UpdateToDoRequest $request, ToDo $toDo)
    {
        $toDo->update($request->all());
        $toDo->for_roles()->sync($request->input('for_roles', []));
        $toDo->for_users()->sync($request->input('for_users', []));
        if (count($toDo->photo) > 0) {
            foreach ($toDo->photo as $media) {
                if (! in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $toDo->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $toDo->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('frontend.to-dos.index');
    }

    public function show(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDo->load('for_roles', 'for_users', 'priority');

        return view('frontend.toDos.show', compact('toDo'));
    }

    public function destroy(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDo->delete();

        return back();
    }

    public function massDestroy(MassDestroyToDoRequest $request)
    {
        $toDos = ToDo::find(request('ids'));

        foreach ($toDos as $toDo) {
            $toDo->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('to_do_create') && Gate::denies('to_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ToDo();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
