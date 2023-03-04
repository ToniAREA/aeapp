<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('desciption');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
