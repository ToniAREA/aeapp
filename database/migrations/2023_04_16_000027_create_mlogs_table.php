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
            $table->integer('id_mlog')->nullable();
            $table->string('description')->nullable();
            $table->float('quantity', 9, 2)->nullable();
            $table->float('price_unit', 9, 2)->nullable();
            $table->float('discount', 5, 2)->nullable();
            $table->float('total', 9, 2)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
