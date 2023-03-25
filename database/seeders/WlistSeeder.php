<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oldWlists = DB::connection('mysql_old')->table('marinas')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldWlists as $wlist) {

            // Convertir el objeto en una cadena JSON
            $json = json_encode($wlist);
            // Mostrar la cadena JSON resultante en la consola
            $this->command->line("Objeto en formato JSON: {$json}");
            $this->command->line("...");

            DB::table('wlists')->insert([
                'id_wlist' => $wlist->id,
                'name' => $wlist->name,
                'coordinates' => $wlist->coordinates,
            ]);
        }
    }
}
