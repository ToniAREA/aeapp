<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBoatsTable extends Migration
{
    public function up()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_type_id')->nullable();
            $table->foreign('boat_type_id', 'boat_type_fk_8343116')->references('id')->on('boats_types');
            $table->unsignedBigInteger('marina_id')->nullable();
            $table->foreign('marina_id', 'marina_fk_8238141')->references('id')->on('marinas');
        });
    }
}
