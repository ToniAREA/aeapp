<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boat;
use App\Models\Client;

class HomeController
{
    public $sources = [
        [
            'model'      => '\App\Models\Employee',
            'date_field' => 'contract_ends',
            'field'      => 'id_employee',
            'prefix'     => 'Employee ENDs',
            'suffix'     => '',
            'route'      => 'admin.employees.edit',
        ],
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'when_starts',
            'field'      => 'id',
            'prefix'     => 'Appointment',
            'suffix'     => '',
            'route'      => 'admin.appointments.edit',
        ],
        [
            'model'      => '\App\Models\Wlist',
            'date_field' => 'deadline',
            'field'      => 'id',
            'prefix'     => 'WorkDeadline',
            'suffix'     => '',
            'route'      => 'admin.wlists.edit',
        ],
    ];

    public function index()
    {
        $clients = Client::get();
        $boats = Boat::get();
        $workingOn = Boat::orderBy('id', 'desc')->take(10)->get();
        $waiting = Client::orderBy('id', 'desc')->take(5)->get();

        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('home', compact('clients','boats', 'events', 'workingOn', 'waiting'));
    }
}
