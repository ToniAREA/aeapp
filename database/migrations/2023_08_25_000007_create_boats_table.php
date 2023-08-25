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
            $table->string('ref')->nullable();
            $table->string('boat_type')->nullable();
            $table->string('name');
            $table->string('imo')->nullable();
            $table->string('mmsi')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('link')->nullable();
            $table->datetime('last_use')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
