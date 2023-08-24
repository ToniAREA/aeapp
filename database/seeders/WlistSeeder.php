<?php

namespace Database\Seeders;

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
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldWlists = DB::connection('mysql_old')->table('wlist')->get();

        //get last id in oldWlists array
        $last_id = $oldWlists->last()->id;
        $last_id++;

        // Insertar los datos en la tabla destino de la nueva base de datos
        for ($i = 1; $i < $last_id; $i++) {

            //find wlist with $i in $oldWlists array
            $wlist = $oldWlists->where('id', $i)->first();
            // if $wlist is null, make a dummy wlist with id $i and name 'empty wlist'
            if ($wlist == null) {
                $this->command->line("<comment>{$i} is null</comment>");
                $wlist = (object) [
                    'created_at' => '',
                    'updated_at' => '',
                    'client_id' => '',
                    'boat_id' => '',
                    'type' => '',
                    'type' => '',
                    'type' => '',
                    'type' => '',
                    'type' => '',
                    'type' => '',
                    'type' => '',
                    
                ];

                /* DB::table('wlists')->insert([
                    'wlist_type' => $wlist->type,
                    'name' => $wlist->name,
                    'mmsi' => $wlist->mmsi,
                    'notes' => $wlist->notes,
                    'internalnotes' => $wlist->internalnotes,
                ]);
 */            } else {
                if ($i != $wlist->id) {
                    $this->command->line("<error>Error: {$i} is not the same as {$wlist->id}</error>");
                } else {
                    $this->command->line("{$i} is the same as {$wlist->id} for \t{$wlist->boat_namecomplete}");

                     DB::table('wlists')->insert([
                        'wlist_type' => $wlist->type,
                        'name' => $wlist->name,
                        'mmsi' => $wlist->mmsi,
                        'notes' => $wlist->notes,
                        'internalnotes' => $wlist->internalnotes,
                    ]);
                }
            }
        }
    }
}
