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

        //get last id in oldBoats array
        $last_id = $oldBoats->last()->id;
        $last_id++;

        // Insertar los datos en la tabla destino de la nueva base de datos
        for ($i = 1; $i < $last_id; $i++) {

            //find boat with $i in $oldBoats array
            $boat = $oldBoats->where('id', $i)->first();
            // if $boat is null, make a dummy boat with id $i and name 'empty boat'
            if ($boat == null) {
                $boat = (object) [
                    'type' => '',
                    'name' => '------',
                    'mmsi' => '',
                    'notes' => '',
                    'internalnotes' => '',
                ];
                DB::table('boats')->insert([
                    'boat_type' => $boat->type,
                    'name' => $boat->name,
                    'mmsi' => $boat->mmsi,
                    'notes' => $boat->notes,
                    'internalnotes' => $boat->internalnotes,
                ]);
            } else {
                if ($i != $boat->id) {
                    $this->command->line("Error: {$i} is not the same as {$boat->id}");
                } else {
                    $this->command->line("{$i} is the same as {$boat->id}");
                    DB::table('boats')->insert([
                        'boat_type' => $boat->type,
                        'name' => $boat->name,
                        'mmsi' => $boat->mmsi,
                        'notes' => $boat->notes,
                        'internalnotes' => $boat->internalnotes,
                        'marina_id' => $boat->marina_id,
                    ]);
                }
            }
        }
    }
}
