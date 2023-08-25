<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContactContactPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_contact_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_8921135')->references('id')->on('clients')->onDelete('cascade');
            $table->unsignedBigInteger('contact_contact_id');
            $table->foreign('contact_contact_id', 'contact_contact_id_fk_8921135')->references('id')->on('contact_contacts')->onDelete('cascade');
        });
    }
}
