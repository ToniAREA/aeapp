<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWlogsTable extends Migration
{
    public function up()
    {
        Schema::create('wlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('boat_namecomplete')->nullable();
            $table->date('date');
            $table->string('description')->nullable();
            $table->float('hours', 4, 2)->nullable();
            $table->boolean('invoiced_line')->default(0)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
