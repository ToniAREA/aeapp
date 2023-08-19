<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoatClientPivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener la conexión a la base de datos source y consulta registros de la tabla boats
        $boats = DB::connection('mysql_old')->table('boats')->get();

        foreach ($boats as $boat) {
            // Comprueba si el registro ya existe en la tabla pivotante en la base de datos target usando la conexión mysql2 (o el nombre de tu segunda conexión)
            $exists = DB::connection('mysql')->table('boat_client')
                ->where('boat_id', $boat->id)
                ->where('client_id', $boat->client_id)
                ->exists();

            // Si no existe, inserta el registro en la tabla pivotante
            if (!$exists) {
                DB::connection('mysql')->table('boat_client')->insert([
                    'boat_id' => $boat->id,
                    'client_id' => $boat->client_id,
                ]);
                $this->command->line("Inserted in boat_client DB: {$boat->id} - {$boat->client_id}");
            }
        }
    }
}
