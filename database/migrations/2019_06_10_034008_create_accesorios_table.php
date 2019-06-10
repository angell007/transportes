<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesoriosTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('accesorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion')->unique();
            $table->enum('disponibilidad', array('si', 'no'));
            $table->text('observacion')->nullable();
            $table->unsignedInteger('vehiculo_placa');
            $table->timestamps();
        });
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('accesorios');
    }
}
