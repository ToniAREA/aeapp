<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'when_starts',
            'field'      => 'description',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.appointments.edit',
        ],
        [
            'model'      => '\App\Models\Wlist',
            'date_field' => 'deadline',
            'field'      => 'desciption',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.wlists.edit',
        ],
        [
            'model'      => '\App\Models\Employee',
            'date_field' => 'contract_ends',
            'field'      => 'id_employee',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.employees.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (! $crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
