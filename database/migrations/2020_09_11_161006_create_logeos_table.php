<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logeos', function (Blueprint $table) {
            $table->bigIncrements('idLogeo'); 
            $table->foreignId('idUsuarioFK');
            $table->integer('intentos');
            
            $table->date('fechaLogeo');    
            $table->time('horaLogeo', 0);  
            $table->enum('estado', ['A', 'I']); 
            $table->string('hash', 256);    

            $table->foreign('idUsuarioFK')->references('idPersona')->on('personas')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logeos');
    }
}
