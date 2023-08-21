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
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldBoats = DB::connection('mysql_old')->table('boats')->get();
        $presentBoats = DB::connection('mysql')->table('boats')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldBoats as $boat) {
            //Print boat name and id
            $this->command->getOutput()->write("\nB{$boat->id}, ");
            $this->command->getOutput()->write("\t{$boat->type} {$boat->name}, ");

            $boat_client = DB::connection('mysql_old')->table('clients')
            ->where('id', $boat->client_id)
            ->first();

            if ($boat_client) {
                $this->command->getOutput()->write("\tC".$boat_client->id."\t".$boat_client->name);
            }

            $boat_exists = DB::connection('mysql')->table('boats')
                ->where('id_boat', $boat->id)
                ->where('name', $boat->name)
                ->exists();

            if ($boat_exists) {
                $this->command->getOutput()->write("\tok");
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
                $this->command->getOutput()->write("\tInserted");
                $presentBoats = DB::connection('mysql')->table('boats')->get();
            }
            

        }}
}