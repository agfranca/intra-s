<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArquivoTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivo__tarefas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arquivos_id')->nullable();
            $table->integer('tarefas_id')->nullable();
            $table->integer('users_id')->nullable();
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
        Schema::dropIfExists('arquivo__tarefas');
    }
}
