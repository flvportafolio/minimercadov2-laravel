<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioSistemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_sistemas', function (Blueprint $table) {
            $table->bigIncrements('idUsuario');         //tiene que ser llave primaria foranea
            $table->string('alias', 50);      
            $table->binary('user');                     //equivalente a blob
            $table->binary('password');                     //equivalente a blob
            $table->date('fecha_registro');    
            $table->time('hora_registro', 0);  
            $table->enum('estado', ['A', 'I']); 
            $table->string('hash', 256);    

            $table->foreign('idUsuario')->references('idPersona')->on('personas')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_sistemas');
    }
}
