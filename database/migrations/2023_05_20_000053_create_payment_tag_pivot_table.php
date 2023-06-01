<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('payment_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id', 'payment_id_fk_8342430')->references('id')->on('payments')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_8342430')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
