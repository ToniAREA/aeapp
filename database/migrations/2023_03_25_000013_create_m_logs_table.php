<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMLogsTable extends Migration
{
    public function up()
    {
        Schema::create('m_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
