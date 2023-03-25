<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldMarinas = DB::connection('mysql_old')->table('marinas')->get();
        
        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldMarinas as $marina) {

             // Convertir el objeto en una cadena JSON
            $json = json_encode($marina);
            // Mostrar la cadena JSON resultante en la consola
            $this->command->line("Objeto en formato JSON: {$json}");
            $this->command->line("...");

            DB::table('marinas')->insert([
                'name' => $marina->name,
                'coordinates' => $marina->coordinates,
            ]);
        }
    }
}
