<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMlogsTable extends Migration
{
    public function up()
    {
        Schema::table('mlogs', function (Blueprint $table) {
            $table->unsignedBigInteger('wlist_id')->nullable();
            $table->foreign('wlist_id', 'wlist_fk_8238709')->references('id')->on('wlists');
        });
    }
}
