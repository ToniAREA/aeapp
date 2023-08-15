<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8231321')->references('id')->on('users');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id', 'contact_fk_8291363')->references('id')->on('contact_contacts');
        });
    }
}
