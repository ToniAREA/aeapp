<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaWlistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('proforma_wlist', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_id');
            $table->foreign('proforma_id', 'proforma_id_fk_8342560')->references('id')->on('proformas')->onDelete('cascade');
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_8342560')->references('id')->on('wlists')->onDelete('cascade');
        });
    }
}
