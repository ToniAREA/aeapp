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
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldBoats = DB::connection('mysql_old')->table('boats')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldBoats as $boat) {
            //Print boat name and id
            $this->command->getOutput()->write("\nB{$boat->id}, ");
            $this->command->getOutput()->write("\t{$boat->type} {$boat->name}, ");

            $boat_client_pivot = DB::connection('mysql')->table('boat_client')
                ->where('client_id', $boat->client_id)
                ->where('boat_id', $boat->id)
                ->exists();

            $client = DB::connection('mysql')->table('clients')
                ->where('id', $boat->client_id)
                ->first();

            if ($boat_client_pivot) {
                $this->command->getOutput()->write("\tC" . $boat->client_id . "\t" . $client->name . "\t<info>exist</info>");
            } else {
                $this->command->getOutput()->write("\tC" . $boat->client_id . "\t" . $client->name . "\t<comment>not exist</comment>");
                DB::table('boat_client')->insert([
                    'client_id' => $boat->client_id,
                    'boat_id' => $boat->id,
                ]);
                $this->command->getOutput()->write("\t<info>Inserted</info>");
            }
        }
    }
}
