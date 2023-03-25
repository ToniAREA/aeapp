<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldClients = DB::connection('mysql_old')->table('clients')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldClients as $client) {
            DB::table('clients')->insert([
                'id_client' => $client->id,
                'name' => $client->name,
                'lastname' => $client->lastname,
                'vat' => $client->vat,
                'address' => $client->address,
                'country' => $client->country,
                'phone' => $client->phone,
                'mobile' => $client->mobile,
                'email' => $client->email,
                'notes' => $client->notes,
                'link_fd' => $client->link_fd,
                'internalnotes' => $client->internalnotes,
                'defaulter' => $client->defaulter
            ]);
        }
    }
}
