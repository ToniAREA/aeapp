<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldBoats = DB::connection('mysql_old')->table('boats')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldBoats as $boat) {

            // Convertir el objeto en una cadena JSON
            $json = json_encode($boat);
            // Mostrar la cadena JSON resultante en la consola
            $this->command->line("Objeto en formato JSON: {$json}");
            $this->command->line("...");


            DB::table('boats')->insert([
                'id_boat' => $boat->id,
                'type' => $boat->type,
                'name' => $boat->name,
                'marina_id' => $boat->marina_id,
                'mmsi' => $boat->mmsi,
                'notes' => $boat->notes,
                'internalnotes' => $boat->internalnotes,
            ]);
        }
    }
}
