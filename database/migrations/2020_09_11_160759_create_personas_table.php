<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('idPersona');  //primary key
            $table->string('nombre', 50);
            $table->string('apellidoPaterno', 50);
            $table->string('apellidoMaterno', 50);
            $table->enum('genero', ['M', 'F']);
            $table->date('fecha_nac');
            $table->string('pais_nac', 50)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('correo', 50);
            $table->string('telefono', 50)->nullable();
            $table->enum('estado_civil', ['S','C','D','V']);
            $table->enum('nivel_educ', ['E','B','U','G']);
            $table->string('profesion', 100)->nullable();
            $table->string('foto', 150)->nullable();

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
        Schema::dropIfExists('personas');
    }
}
