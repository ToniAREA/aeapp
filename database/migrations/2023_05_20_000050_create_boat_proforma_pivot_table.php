<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatProformaPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_proforma', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_id');
            $table->foreign('proforma_id', 'proforma_id_fk_8342559')->references('id')->on('proformas')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_8342559')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
