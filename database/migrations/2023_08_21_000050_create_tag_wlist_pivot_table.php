<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagWlistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('tag_wlist', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_8342062')->references('id')->on('wlists')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_8342062')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
