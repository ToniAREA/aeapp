<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProformaTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('proforma_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_id');
            $table->foreign('proforma_id', 'proforma_id_fk_8342429')->references('id')->on('proformas')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_8342429')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
