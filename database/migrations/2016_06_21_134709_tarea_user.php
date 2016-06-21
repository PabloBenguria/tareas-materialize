<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TareaUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarea_user', function(Blueprint $tabla){
            $tabla->increments('id');
            $tabla->integer('tarea_id')->unsigned();
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
        Schema::dropIfExists('tarea_user');
    }
}
