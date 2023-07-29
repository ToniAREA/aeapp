<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMlogsTable extends Migration
{
    public function up()
    {
        Schema::table('mlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_8337893')->references('id')->on('clients');
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_8337894')->references('id')->on('boats');
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_8342553')->references('id')->on('wlists');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_8292179')->references('id')->on('products');
            $table->unsignedBigInteger('proforma_number_id')->nullable();
            $table->foreign('proforma_number_id', 'proforma_number_fk_8338402')->references('id')->on('proformas');
        });
    }
}
