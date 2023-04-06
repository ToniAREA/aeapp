<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatMarinaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_marina', function (Blueprint $table) {
            $table->unsignedBigInteger('marina_id');
            $table->foreign('marina_id', 'marina_id_fk_8162382')->references('id')->on('marinas')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_8162382')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
