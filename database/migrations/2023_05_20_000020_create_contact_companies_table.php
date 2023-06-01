<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('defaulter')->default(0)->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_vat')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_mobile')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_social_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
