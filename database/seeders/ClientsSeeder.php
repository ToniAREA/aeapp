<?php

namespace Database\Seeders;

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

        //get last id in oldClients array
        $last_id = $oldClients->last()->id;
        $last_id++;

        // Insertar los datos en la tabla destino de la nueva base de datos
        for ($i = 0; $i < $last_id; $i++) {

            //check next id in clients table
            $this->command->line("Next id in clients table: {$i}");

            //find client with $i in $oldClients array
            $client = $oldClients->where('id', $i)->first();
            // if $client is null, make a dummy client with id $i and name 'empty client' 
            if ($client == null) {
                $client = (object) [
                    'name' => 'empty client',
                    'lastname' => '',
                    'vat' => '',
                    'address' => '',
                    'country' => '',
                    'phone' => '',
                    'mobile' => '',
                    'email' => '',
                    'notes' => '',
                    'internalnotes' => '',
                    'link_fd' => '',
                    'coordinates' => '',
                ];
            }

            $this->command->line("Client with id {$i} in oldClients array: {$client->name}");

            //check if client exists in clients table
            $client_exists = DB::connection('mysql')->table('clients')
                ->where('id', $i)
                ->exists();

            if ($client_exists) {
                $this->command->line("Client with id {$i} exists in clients table");
            } else {
                $this->command->line("Client with id {$i} does not exist in clients table");
                DB::table('clients')->insert([
                    'name' => $client->name,
                    'lastname' => $client->lastname,
                    'vat' => $client->vat,
                    'address' => $client->address,
                    'country' => $client->country,
                    'telephone' => $client->phone,
                    'mobile' => $client->mobile,
                    'email' => $client->email,
                    'notes' => $client->notes,
                    'internalnotes' => $client->internalnotes,
                    'link' => $client->link_fd,
                    'coordinates' => $client->coordinates,
                ]);
                $this->command->line("Client with id {$i} inserted in clients table");
            }
        }
    }
}
