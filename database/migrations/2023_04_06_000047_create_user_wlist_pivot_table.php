<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWlistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_wlist', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_8291369')->references('id')->on('wlists')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_8291369')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
