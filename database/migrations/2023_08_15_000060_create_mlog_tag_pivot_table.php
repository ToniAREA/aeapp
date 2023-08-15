<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMlogTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('mlog_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('mlog_id');
            $table->foreign('mlog_id', 'mlog_id_fk_8292186')->references('id')->on('mlogs')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_8292186')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
