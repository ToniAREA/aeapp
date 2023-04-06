<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boat;
use App\Models\Client;

class HomeController
{
    public function index()
    {
        $clients = Client::get();
        $boats = Boat::get();

        return view('home', compact('clients','boats'));
    }
}
