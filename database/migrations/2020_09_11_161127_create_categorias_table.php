<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->bigIncrements('idCategoria');         //es auto incrementable y primary key a la vez
            $table->string('nombre', 50);       //equivalente a: varchar 50 con not null por defecto
            $table->string('descripcion', 500)->nullable(); //equivalente a: varchar 500  pero acepta valores nulos
            $table->date('fecha_registro');    //equivalente a: `fecha_registro` DATE NOT NULL,
            $table->time('hora_registro', 0);  //equivalente a: `hora_registro` TIME NOT NULL,
            $table->enum('estado', ['A', 'I']);  //equivalente a: `estado` enum('A', 'I') NOT NULL,
            $table->string('hash', 256);       //varchar 50 equivalente con not null por defecto                                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
