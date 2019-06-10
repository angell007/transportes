<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventariosTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('inventarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('inventarios');
    }
}
