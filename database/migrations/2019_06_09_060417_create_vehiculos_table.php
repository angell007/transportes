<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    public function up()
    {
        // create table
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('proveedor_id');
            $table->enum('tipo',array('publico','particular'));
            $table->string('placa');
            $table->string('numero_licencia');
            $table->string('marca');
            $table->string('soat');
            $table->string('tecnomecanica');
            $table->string('poliza');
            $table->string('modelo');
            $table->string('color');
            $table->string('kilometraje');
            $table->timestamps();
        });
    }

    public function down()
    {
        // drop table
        Schema::dropIfExists('vehiculos');
    }
}
