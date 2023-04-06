<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_8291362')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_8291362')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
