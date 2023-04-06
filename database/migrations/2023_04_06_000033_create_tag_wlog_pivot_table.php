<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagWlogPivotTable extends Migration
{
    public function up()
    {
        Schema::create('tag_wlog', function (Blueprint $table) {
            $table->unsignedBigInteger('wlog_id');
            $table->foreign('wlog_id', 'wlog_id_fk_8239263')->references('id')->on('wlogs')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_8239263')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
