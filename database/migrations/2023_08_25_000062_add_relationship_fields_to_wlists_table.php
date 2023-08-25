<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWlistsTable extends Migration
{
    public function up()
    {
        Schema::table('wlists', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_8901291')->references('id')->on('clients');
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_7894053')->references('id')->on('boats');
            $table->unsignedBigInteger('priority_id')->nullable();
            $table->foreign('priority_id', 'priority_fk_8921469')->references('id')->on('priorities');
        });
    }
}
