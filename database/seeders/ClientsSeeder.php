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
        for ($i = 1; $i < $last_id; $i++) {

            //find client with $i in $oldClients array
            $client = $oldClients->where('id', $i)->first();
            // if $client is null, make a dummy client with id $i and name 'empty client' 
            if ($client == null) {
                $client = (object) [
                    'name' => '------',
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
            } else {
                //check that $i is the same as $client->id
                if ($i != $client->id) {
                    $this->command->line("Error: {$i} is not the same as {$client->id}");
                } else {
                    $this->command->line("{$i} is the same as {$client->id}");
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
                }
            }
        }
    }
}
