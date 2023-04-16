<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarinasTable extends Migration
{
    public function up()
    {
        Schema::create('marinas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_marina')->nullable();
            $table->string('name')->unique();
            $table->string('coordinates')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
