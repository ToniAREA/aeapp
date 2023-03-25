<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatBoatsTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_boats_type', function (Blueprint $table) {
            $table->unsignedBigInteger('boats_type_id');
            $table->foreign('boats_type_id', 'boats_type_id_fk_8238689')->references('id')->on('boats_types')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_8238689')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
