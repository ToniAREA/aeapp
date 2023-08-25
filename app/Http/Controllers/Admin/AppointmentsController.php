<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Boat;
use App\Models\Client;
use App\Models\Priority;
use App\Models\Role;
use App\Models\User;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Appointment::with(['client', 'boat', 'wlists', 'for_roles', 'for_users', 'priority'])->select(sprintf('%s.*', (new Appointment)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointment_show';
                $editGate      = 'appointment_edit';
                $deleteGate    = 'appointment_delete';
                $crudRoutePart = 'appointments';

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

            $table->editColumn('wlists', function ($row) {
                $labels = [];
                foreach ($row->wlists as $wlist) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $wlist->description);
                }

                return implode(' ', $labels);
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

            $table->addColumn('priority_name', function ($row) {
                return $row->priority ? $row->priority->name : '';
            });

            $table->editColumn('priority.weight', function ($row) {
                return $row->priority ? (is_string($row->priority) ? $row->priority : $row->priority->weight) : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('coordinates', function ($row) {
                return $row->coordinates ? $row->coordinates : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'boat', 'wlists', 'for_role', 'for_user', 'priority']);

            return $table->make(true);
        }

        return view('admin.appointments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('boats', 'clients', 'for_roles', 'for_users', 'priorities', 'wlists'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());
        $appointment->wlists()->sync($request->input('wlists', []));
        $appointment->for_roles()->sync($request->input('for_roles', []));
        $appointment->for_users()->sync($request->input('for_users', []));

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id');

        $for_roles = Role::pluck('title', 'id');

        $for_users = User::pluck('name', 'id');

        $priorities = Priority::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('client', 'boat', 'wlists', 'for_roles', 'for_users', 'priority');

        return view('admin.appointments.edit', compact('appointment', 'boats', 'clients', 'for_roles', 'for_users', 'priorities', 'wlists'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        $appointment->wlists()->sync($request->input('wlists', []));
        $appointment->for_roles()->sync($request->input('for_roles', []));
        $appointment->for_users()->sync($request->input('for_users', []));

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('client', 'boat', 'wlists', 'for_roles', 'for_users', 'priority');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        $appointments = Appointment::find(request('ids'));

        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
