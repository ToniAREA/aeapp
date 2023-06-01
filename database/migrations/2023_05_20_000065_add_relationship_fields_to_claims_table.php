<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClaimsTable extends Migration
{
    public function up()
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_number_id')->nullable();
            $table->foreign('proforma_number_id', 'proforma_number_fk_8338404')->references('id')->on('proformas');
        });
    }
}
