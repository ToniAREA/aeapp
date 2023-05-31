<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('defaulter')->default(0)->nullable();
            $table->integer('id_client')->unique();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->string('link')->nullable();
            $table->string('coordinates')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
