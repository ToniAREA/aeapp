<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_boat')->unique();
            $table->string('name');
            $table->integer('mmsi')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->date('lastuse')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
