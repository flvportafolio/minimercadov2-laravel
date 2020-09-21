<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadoUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_usuarios', function (Blueprint $table) {
            $table->bigIncrements('idEmpleado');
            $table->foreignId('idCargoFK');
            $table->integer('ci');
            $table->binary('user');                     //equivalente a blob
            $table->binary('password');  
            
            $table->date('fecha_registro');    
            $table->time('hora_registro', 0);  
            $table->enum('estado', ['A', 'I']); 
            $table->string('hash', 256);    

            $table->foreign('idEmpleado')->references('idPersona')->on('personas')->onDelete('cascade'); 
            $table->foreign('idCargoFK')->references('idCargo')->on('cargos')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado_usuarios');
    }
}
