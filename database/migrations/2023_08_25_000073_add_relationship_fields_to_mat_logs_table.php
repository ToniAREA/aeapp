<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMatLogsTable extends Migration
{
    public function up()
    {
        Schema::table('mat_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_8880470')->references('id')->on('boats');
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_8880471')->references('id')->on('wlists');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_8880473')->references('id')->on('users');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_8921167')->references('id')->on('products');
            $table->unsignedBigInteger('proforma_number_id')->nullable();
            $table->foreign('proforma_number_id', 'proforma_number_fk_8880479')->references('id')->on('proformas');
        });
    }
}
