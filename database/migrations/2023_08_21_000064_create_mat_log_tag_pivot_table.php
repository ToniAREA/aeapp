<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatLogTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('mat_log_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('mat_log_id');
            $table->foreign('mat_log_id', 'mat_log_id_fk_8880478')->references('id')->on('mat_logs')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_8880478')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
