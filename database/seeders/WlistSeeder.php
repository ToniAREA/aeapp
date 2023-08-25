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
                $this->command->line("<comment>{$wlist} is null</comment>");

                // create wlist object  with id $i and name 'empty wlist'

                


                $wlist = (object) [
                    'order_type' => 'empty',
                    'client_id' => '',
                    'boat_id' => '',
                    'order_type' => '',
                    'description' => '------',
                    'deadline' => '',
                    'status' => '',
                    'url_invoice' => '',
                    'created_at' => now(),
                    'updated_at' => now(),

                ];

                $this->command->line("<comment>{$wlist->id}</comment>");
                $this->command->line("<comment>{$wlist->type}</comment>");
                $this->command->line("<comment>{$wlist->client_id}</comment>");
                $this->command->line("<comment>{$wlist->boat_id}</comment>");
                $this->command->line("<comment>{$wlist->description}</comment>");
                $this->command->line("<comment>{$wlist->deadline}</comment>");
                $this->command->line("<comment>{$wlist->status}</comment>");
                $this->command->line("<comment>{$wlist->link_dn}</comment>");
                $this->command->line("<comment>{$wlist->created_at}</comment>");
                $this->command->line("<comment>{$wlist->updated_at}</comment>");


                DB::table('wlists')->insert([
                    'order_type' => $wlist->type,
                    'client_id' => $wlist->client_id,
                    'boat_id' => $wlist->boat_id,
                    'order_type' => $wlist->type,
                    'description' => $wlist->description,
                    'deadline' => $wlist->deadline,
                    'status' => $wlist->status,
                    'url_invoice' => $wlist->link_dn,
                    'created_at' => $wlist->created_at,
                    'updated_at' => $wlist->updated_at,
                ]);

            } else {

                if ($i != $wlist->id) {
                    $this->command->line("<error>Error: {$i} is not the same as {$wlist->id}</error>");
                } else {
                    $this->command->line("{$i} is the same as {$wlist->id} for \t{$wlist->boat_namecomplete}");

                    DB::table('wlists')->insert([
                        'order_type' => $wlist->type,
                        'client_id' => $wlist->client_id,
                        'boat_id' => $wlist->boat_id,
                        'order_type' => $wlist->type,
                        'description' => $wlist->description,
                        'deadline' => $wlist->deadline,
                        'status' => $wlist->status,
                        'url_invoice' => $wlist->link_dn,
                        'created_at' => $wlist->created_at,
                        'updated_at' => $wlist->updated_at,
                    ]);
                }
            }
        }
    }
}
