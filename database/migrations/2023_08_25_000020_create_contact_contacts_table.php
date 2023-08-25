<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_nif')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_country')->nullable();
            $table->string('contact_mobile')->nullable();
            $table->string('contact_mobile_2')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_email_2')->nullable();
            $table->string('social_link')->nullable();
            $table->string('contact_tags')->nullable();
            $table->string('contact_notes')->nullable();
            $table->string('contact_internalnotes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
