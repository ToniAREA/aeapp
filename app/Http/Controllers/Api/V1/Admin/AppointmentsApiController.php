<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\Admin\AppointmentResource;
use App\Models\Appointment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentResource(Appointment::with(['client', 'boat', 'wlists', 'for_roles', 'for_users', 'priority'])->get());
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());
        $appointment->wlists()->sync($request->input('wlists', []));
        $appointment->for_roles()->sync($request->input('for_roles', []));
        $appointment->for_users()->sync($request->input('for_users', []));

        return (new AppointmentResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentResource($appointment->load(['client', 'boat', 'wlists', 'for_roles', 'for_users', 'priority']));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());
        $appointment->wlists()->sync($request->input('wlists', []));
        $appointment->for_roles()->sync($request->input('for_roles', []));
        $appointment->for_users()->sync($request->input('for_users', []));

        return (new AppointmentResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
