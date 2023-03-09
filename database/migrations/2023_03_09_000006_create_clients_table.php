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
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('vat')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->string('defaulter')->nullable();
            $table->date('lastuse')->nullable();
            $table->string('link_fd')->nullable();
            $table->string('coordinates')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
