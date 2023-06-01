<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_number_id')->nullable();
            $table->foreign('proforma_number_id', 'proforma_number_fk_8342399')->references('id')->on('proformas');
        });
    }
}
