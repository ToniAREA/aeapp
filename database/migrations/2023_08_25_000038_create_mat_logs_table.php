<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatLogsTable extends Migration
{
    public function up()
    {
        Schema::create('mat_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('boat_namecomplete')->nullable();
            $table->date('date');
            $table->string('item')->nullable();
            $table->string('description')->nullable();
            $table->float('pvp', 10, 2)->nullable();
            $table->float('units', 10, 2)->nullable();
            $table->boolean('invoiced_line')->default(0)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
