<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleToDoPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_to_do', function (Blueprint $table) {
            $table->unsignedBigInteger('to_do_id');
            $table->foreign('to_do_id', 'to_do_id_fk_8290020')->references('id')->on('to_dos')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_8290020')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
