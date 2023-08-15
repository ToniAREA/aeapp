<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BoatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::dropIfExists('boats');
        Schema::dropIfExists('boat_client');

        // Obtener datos de la tabla origen de la base de datos antigua
        $oldBoats = DB::connection('mysql_old')->table('boats')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldBoats as $boat) {

            // Convertir el objeto en una cadena JSON
            $json = json_encode($boat);
            // Mostrar la cadena JSON resultante en la consola
            $this->command->line("Objeto en formato JSON: {$json}");
            $this->command->line("...");

            if ($boat->type == 'XX') {
                $boat->type = '1';
            } elseif ($boat->type == 'MY') {
                $boat->type = '2';
            } elseif ($boat->type == 'SY') {
                $boat->type = '3';
            } elseif ($boat->type == 'TT') {
                $boat->type = '4';
            }

            DB::table('boats')->insert([
                'id_boat' => $boat->id,
                'boat_type_id' => $boat->type,
                'name' => $boat->name,
                'marina_id' => $boat->marina_id,
                'mmsi' => $boat->mmsi,
                'notes' => $boat->notes,
                'internalnotes' => $boat->internalnotes,
            ]);

            DB::table('boat_client')->insert([
                'boat_id' => $boat->id,
                'client_id' => $boat->client_id,
            ]);

            $this->command->line("Inserted in coat_client DB: {$boat->id} - {$boat->client_id}");

    }
}}