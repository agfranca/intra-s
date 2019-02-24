<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentoNoticiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento__noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departamento_id')->unsigned();    
            $table->integer('noticia_id')->unsigned();
            $table->integer('empresa_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('redistribuir_noticias_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamento__noticias');
    }
}
