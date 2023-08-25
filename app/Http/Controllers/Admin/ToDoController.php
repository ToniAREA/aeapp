<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ToDoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('to_do_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ToDo::with(['for_roles', 'for_users', 'priority'])->select(sprintf('%s.*', (new ToDo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'to_do_show';
                $editGate      = 'to_do_edit';
                $deleteGate    = 'to_do_delete';
                $crudRoutePart = 'to-dos';

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
            $table->editColumn('for_role', function ($row) {
                $labels = [];
                foreach ($row->for_roles as $for_role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $for_role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('for_user', function ($row) {
                $labels = [];
                foreach ($row->for_users as $for_user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $for_user->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('task', function ($row) {
                return $row->task ? $row->task : '';
            });
            $table->editColumn('photo', function ($row) {
                if (! $row->photo) {
                    return '';
                }
                $links = [];
                foreach ($row->photo as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->addColumn('priority_name', function ($row) {
                return $row->priority ? $row->priority->name : '';
            });

            $table->editColumn('priority.weight', function ($row) {
                return $row->priority ? (is_string($row->priority) ? $row->priority : $row->priority->weight) : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'for_role', 'for_user', 'photo', 'priority']);

            return $table->make(true);
        }

        return view('admin.toDos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('to_do_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.toDos.create', compact('for_roles', 'for_users', 'priorities'));
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

        return redirect()->route('admin.to-dos.index');
    }

    public function edit(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $toDo->load('for_roles', 'for_users', 'priority');

        return view('admin.toDos.edit', compact('for_roles', 'for_users', 'priorities', 'toDo'));
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

        return redirect()->route('admin.to-dos.index');
    }

    public function show(ToDo $toDo)
    {
        abort_if(Gate::denies('to_do_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toDo->load('for_roles', 'for_users', 'priority');

        return view('admin.toDos.show', compact('toDo'));
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
