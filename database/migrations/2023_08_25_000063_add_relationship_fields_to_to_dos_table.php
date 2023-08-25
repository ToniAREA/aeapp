<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToToDosTable extends Migration
{
    public function up()
    {
        Schema::table('to_dos', function (Blueprint $table) {
            $table->unsignedBigInteger('priority_id')->nullable();
            $table->foreign('priority_id', 'priority_fk_8921470')->references('id')->on('priorities');
        });
    }
}
