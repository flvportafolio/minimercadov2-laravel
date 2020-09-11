<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categorias', function (Blueprint $table) {
            $table->bigIncrements('idSubCategoria');         
            $table->string('nombre', 50);       
            $table->string('descripcion', 500)->nullable();
            $table->foreignId('idCategoriaFK');
            $table->date('fecha_registro');    
            $table->time('hora_registro', 0);  
            $table->enum('estado', ['A', 'I']); 
            $table->string('hash', 256);    

            $table->foreign('idCategoriaFK')->references('idCategoria')->on('categorias')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categorias');
    }
}
