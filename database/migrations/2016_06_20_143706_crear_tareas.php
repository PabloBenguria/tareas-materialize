<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTareas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
       {
           Schema::create('tareas', function(Blueprint $tabla){
             $tabla->increments('id');
             $tabla->string('texto');
             $tabla->enum('estado', ['Pendiente', 'Completada'])->default('Pendiente');
             $tabla->integer('user_id')->unsigned();
             $tabla->timestamps();
           });
       }

       /**
        * Reverse the migrations.
        *
        * @return void
        */
       public function down()
       {
           Schema::dropIfExists('tareas');
       }
}
