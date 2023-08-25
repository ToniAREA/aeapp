<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatClientPivotTable extends Migration
{
    public function up()
    {
        Schema::create('boat_client', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_7893992')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_7893992')->references('id')->on('boats')->onDelete('cascade');
        });
    }
}
