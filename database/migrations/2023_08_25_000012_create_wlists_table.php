<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWlistsTable extends Migration
{
    public function up()
    {
        Schema::create('wlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_type')->nullable();
            $table->string('boat_namecomplete')->nullable();
            $table->string('description')->nullable();
            $table->date('deadline')->nullable();
            $table->string('status')->nullable();
            $table->string('url_invoice')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
