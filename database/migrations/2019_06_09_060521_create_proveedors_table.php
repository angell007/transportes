<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('proveedors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullnombre');
            $table->string('documento')->unique();
            $table->string('contacto')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('proveedors');
    }
}
