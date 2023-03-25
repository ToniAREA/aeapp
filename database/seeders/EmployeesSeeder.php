<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener datos de la tabla origen de la base de datos antigua
        $oldEmployees = DB::connection('mysql_old')->table('employees')->get();

        // Insertar los datos en la tabla destino de la nueva base de datos
        foreach ($oldEmployees as $employee) {
            
            // Convertir el objeto en una cadena JSON
            $json = json_encode($employee);
            // Mostrar la cadena JSON resultante en la consola
            $this->command->line("Objeto en formato JSON: {$json}");
            $this->command->line("...");

            DB::table('employees')->insert([
                'id_employee' => $employee->id,
                'user_id' => $employee->user_id,
                // 'name' => $employee->name,
                // 'lastname' => $employee->lastname,
                // 'nif' => $employee->nif,
                // 'address' => $employee->address,
                // 'country' => $employee->country,
                // 'email' => $employee->email,
                // 'phone' => $employee->phone,
                // 'mobile' => $employee->mobile,
                'notes' => $employee->notes,
                'internalnotes' => $employee->internalnotes,
                'status' => $employee->status,
            ]);
        }
    }
}
