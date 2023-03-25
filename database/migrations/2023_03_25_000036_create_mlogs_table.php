<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMlogsTable extends Migration
{
    public function up()
    {
        Schema::create('mlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_mlog')->nullable();
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
