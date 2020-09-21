<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->bigIncrements('idCargo');
            $table->string('nombre', 50);      
            $table->string('descripcion', 500)->nullable();

            $table->date('fecha_registro');    
            $table->time('hora_registro', 0);  
            $table->enum('estado', ['A', 'I']); 
            $table->string('hash', 256);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargos');
    }
}
