<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWlogsTable extends Migration
{
    public function up()
    {
        Schema::table('wlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_8342547')->references('id')->on('wlists');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id', 'employee_fk_8238948')->references('id')->on('users');
            $table->unsignedBigInteger('marina_id')->nullable();
            $table->foreign('marina_id', 'marina_fk_8239254')->references('id')->on('marinas');
            $table->unsignedBigInteger('proforma_number_id')->nullable();
            $table->foreign('proforma_number_id', 'proforma_number_fk_8338401')->references('id')->on('proformas');
        });
    }
}
