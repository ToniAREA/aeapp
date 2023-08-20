<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Schema::dropIfExists('boats');
        #Schema::dropIfExists('boat_client');

        // Obtener datos de la tabla origen de la base de datos antigua
        $oldBoats = DB::connection('mysql_old')->table('boats')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldBoats as $boat) {

            // Convertir el objeto en una cadena JSON
            $json = json_encode($boat);
            // Mostrar la cadena JSON resultante en la consola
            //$this->command->line("Objeto en formato JSON: {$json}");
            //$this->command->line("...");

            
            $boat_exists = DB::connection('mysql')->table('boats')
                ->where('id_boat', $boat->id)
                ->exists();

            if ($boat_exists) {
                //$this->command->line("Already exists in boats DB: {$boat->id}");
            } else {
                DB::table('boats')->insert([
                    'id_boat' => $boat->id,
                    'boat_type' => $boat->type,
                    'name' => $boat->name,
                    'marina_id' => $boat->marina_id,
                    'mmsi' => $boat->mmsi,
                    'notes' => $boat->notes,
                    'internalnotes' => $boat->internalnotes,
                ]);
                $this->command->line("Inserted in boats DB: {$boat->id}");
                $oldBoats = DB::connection('mysql_old')->table('boats')->get();
            }


            // Comprueba si el registro ya existe en la tabla pivotante en la base de datos target usando la conexión mysql2 (o el nombre de tu segunda conexión)
            $exists = DB::connection('mysql')->table('boat_client')
                ->where('boat_id', $boat->id)
                ->where('client_id', $boat->client_id)
                ->exists();

            // Si no existe, inserta el registro en la tabla pivotante
            if (!$exists) {
                $this->command->line("\nNOT in pivot boat_client {$boat->id} - {$boat->client_id}");

                $boatExists = DB::table('boats')->where('id_boat', $boat->id)->exists();
                if ($boatExists) {
                    //$this->command->line("Boat ID{$boat->id} exists in boats_table");
                    $clientExists = DB::table('clients')->where('id_client', $boat->client_id)->exists();
                    if ($clientExists) {
                        //$this->command->line("Client ID{$boat->client_id} exists in clients_table");
                        DB::connection('mysql')->table('boat_client')->insert([
                            'boat_id' => $boat->id,
                            'client_id' => $boat->client_id,
                        ]);
                        $this->command->line("\nInserted in boat_client DB: {$boat->id} - {$boat->client_id}");
                    } else {
                        $this->command->line("C\nlient ID{$boat->client_id} does NOT exist in clients_table");
                    }
                } else {
                    $this->command->line("\nBoat ID{$boat->id} does NOT exist in boats DB");
                }
            } else {
                //$this->command->line("Already exists in PIVOT boat_client DB: {$boat->id} - {$boat->client_id}");
            }
            
            $this->command->getOutput()->write('.');
        }
    }
}