<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand')->unique();
            $table->string('brand_url')->nullable();
            $table->string('notes')->nullable();
            $table->string('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
