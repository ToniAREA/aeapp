<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToDoUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('to_do_user', function (Blueprint $table) {
            $table->unsignedBigInteger('to_do_id');
            $table->foreign('to_do_id', 'to_do_id_fk_8290021')->references('id')->on('to_dos')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_8290021')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
