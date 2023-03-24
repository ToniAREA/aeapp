<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWlistWlogPivotTable extends Migration
{
    public function up()
    {
        Schema::create('wlist_wlog', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_7894035')->references('id')->on('wlists')->onDelete('cascade');
            $table->unsignedBigInteger('wlog_id');
            $table->foreign('wlog_id', 'wlog_id_fk_7894035')->references('id')->on('wlogs')->onDelete('cascade');
        });
    }
}
