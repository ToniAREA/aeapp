<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompanyContactContactPivotTable extends Migration
{
    public function up()
    {
        Schema::create('contact_company_contact_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_company_id');
            $table->foreign('contact_company_id', 'contact_company_id_fk_8921368')->references('id')->on('contact_companies')->onDelete('cascade');
            $table->unsignedBigInteger('contact_contact_id');
            $table->foreign('contact_contact_id', 'contact_contact_id_fk_8921368')->references('id')->on('contact_contacts')->onDelete('cascade');
        });
    }
}
