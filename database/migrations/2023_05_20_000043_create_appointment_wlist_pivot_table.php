<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentWlistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_wlist', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_8342555')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_8342555')->references('id')->on('wlists')->onDelete('cascade');
        });
    }
}
