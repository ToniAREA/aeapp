<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWlogsTable extends Migration
{
    public function up()
    {
        Schema::table('wlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_7894040')->references('id')->on('wlists');
        });
    }
}
