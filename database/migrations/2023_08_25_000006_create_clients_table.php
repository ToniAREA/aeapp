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
            $table->string('ref')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('vat')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('notes')->nullable();
            $table->string('internalnotes')->nullable();
            $table->string('link')->nullable();
            $table->string('coordinates')->nullable();
            $table->datetime('last_use')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
