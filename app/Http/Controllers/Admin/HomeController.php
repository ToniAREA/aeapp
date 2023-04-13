<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boat;
use App\Models\Client;
use App\Models\Wlist;
use App\Models\Wlog;

class HomeController
{
    public $sources = [
        [
            'model'      => '\App\Models\Employee',
            'date_field' => 'contract_ends',
            'field'      => 'id_employee',
            'prefix'     => 'Employee ENDs',
            'suffix'     => '',
            'route'      => 'admin.employees.show',
        ],
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'when_starts',
            'field'      => 'id',
            'prefix'     => 'Appointment',
            'suffix'     => '',
            'route'      => 'admin.appointments.show',
        ],
        [
            'model'      => '\App\Models\Wlist',
            'date_field' => 'deadline',
            'field'      => 'client',
            'prefix'     => 'DL: ',
            'suffix'     => '',
            'route'      => 'admin.wlists.show',
        ],
    ];

    public function index()
    {
        $clients_count = Client::count();
        $boats_count = Boat::count();
        $wlists_count = Wlist::count();
        $wlogs_count = Wlog::count();

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

        return view('home', compact('clients_count','boats_count', 'wlists_count', 'wlogs_count', 'events', 'workingOn', 'waiting'));
    }
}
