<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('idProducto');         
            $table->string('nombre', 50);       
            $table->string('descripcion', 500)->nullable();
            $table->string('foto', 150)->nullable();       
            $table->foreignId('idSubCategoriaFK');
            $table->foreignId('idMarcaFK');

            $table->date('fecha_registro');    
            $table->time('hora_registro', 0);  
            $table->enum('estado', ['A', 'I']); 
            $table->string('hash', 256);  

            $table->foreign('idSubCategoriaFK')->references('idSubCategoria')->on('sub_categorias')->onDelete('cascade');   
            $table->foreign('idMarcaFK')->references('idMarca')->on('marcas')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
