<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBoatsTable extends Migration
{
    public function up()
    {
        Schema::table('boats', function (Blueprint $table) {
            $table->unsignedBigInteger('marina_id')->nullable();
            $table->foreign('marina_id', 'marina_fk_8162366')->references('id')->on('marinas');
        });
    }
}
