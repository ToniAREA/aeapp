<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandProviderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('brand_provider', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id', 'provider_id_fk_8342954')->references('id')->on('providers')->onDelete('cascade');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id', 'brand_id_fk_8342954')->references('id')->on('brands')->onDelete('cascade');
        });
    }
}
