<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('when_starts');
            $table->datetime('when_ends');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
