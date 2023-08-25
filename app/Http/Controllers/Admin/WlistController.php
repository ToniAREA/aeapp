<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWlistRequest;
use App\Http\Requests\StoreWlistRequest;
use App\Http\Requests\UpdateWlistRequest;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Priority;
use App\Models\Role;
use App\Models\User;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WlistController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('wlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Wlist::with(['client', 'boat', 'for_roles', 'for_users', 'priority'])->select(sprintf('%s.*', (new Wlist)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'wlist_show';
                $editGate      = 'wlist_edit';
                $deleteGate    = 'wlist_delete';
                $crudRoutePart = 'wlists';

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
            $table->addColumn('client_name', function ($row) {
                return $row->client ? $row->client->name : '';
            });

            $table->editColumn('client.lastname', function ($row) {
                return $row->client ? (is_string($row->client) ? $row->client : $row->client->lastname) : '';
            });
            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('order_type', function ($row) {
                return $row->order_type ? Wlist::ORDER_TYPE_RADIO[$row->order_type] : '';
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
            $table->editColumn('boat_namecomplete', function ($row) {
                return $row->boat_namecomplete ? $row->boat_namecomplete : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('photos', function ($row) {
                if (! $row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
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
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('url_invoice', function ($row) {
                return $row->url_invoice ? $row->url_invoice : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'boat', 'for_role', 'for_user', 'photos', 'priority']);

            return $table->make(true);
        }

        return view('admin.wlists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('wlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.wlists.create', compact('boats', 'clients', 'for_roles', 'for_users', 'priorities'));
    }

    public function store(StoreWlistRequest $request)
    {
        $wlist = Wlist::create($request->all());
        $wlist->for_roles()->sync($request->input('for_roles', []));
        $wlist->for_users()->sync($request->input('for_users', []));
        foreach ($request->input('photos', []) as $file) {
            $wlist->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $wlist->id]);
        }

        return redirect()->route('admin.wlists.index');
    }

    public function edit(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlist->load('client', 'boat', 'for_roles', 'for_users', 'priority');

        return view('admin.wlists.edit', compact('boats', 'clients', 'for_roles', 'for_users', 'priorities', 'wlist'));
    }

    public function update(UpdateWlistRequest $request, Wlist $wlist)
    {
        $wlist->update($request->all());
        $wlist->for_roles()->sync($request->input('for_roles', []));
        $wlist->for_users()->sync($request->input('for_users', []));
        if (count($wlist->photos) > 0) {
            foreach ($wlist->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $wlist->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $wlist->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.wlists.index');
    }

    public function show(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->load('client', 'boat', 'for_roles', 'for_users', 'priority', 'wlistWlogs', 'wlistMatLogs', 'wlistsAppointments', 'wlistsProformas');

        return view('admin.wlists.show', compact('wlist'));
    }

    public function destroy(Wlist $wlist)
    {
        abort_if(Gate::denies('wlist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wlist->delete();

        return back();
    }

    public function massDestroy(MassDestroyWlistRequest $request)
    {
        $wlists = Wlist::find(request('ids'));

        foreach ($wlists as $wlist) {
            $wlist->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('wlist_create') && Gate::denies('wlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Wlist();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
