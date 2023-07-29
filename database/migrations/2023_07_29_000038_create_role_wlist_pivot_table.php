<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleWlistPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_wlist', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id');
            $table->foreign('wlist_id', 'wlist_id_fk_8291368')->references('id')->on('wlists')->onDelete('cascade');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id', 'role_id_fk_8291368')->references('id')->on('roles')->onDelete('cascade');
        });
    }
}
