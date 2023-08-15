<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_role', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_8291361')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_8291361')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
