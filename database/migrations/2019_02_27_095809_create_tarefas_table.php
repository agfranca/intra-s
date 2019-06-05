<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarefasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id');
            $table->timestamps();
            $table->string('nome')->nullable();
            $table->text('descricao')->nullable();
            $table->datetime('entrega')->nullable();
            $table->string('anexo')->nullable();
            $table->enum('prioridade', array( 'Baixa', 'Normal', 'Alta'))->nullable();
            $table->enum('status', array('A Fazer', 'Em Andamento', 'Concluído', 'Arquivado', 'Para Aprovação'))->nullable();
            $table->integer('iddestino')->nullable();
            $table->integer('idtarefapai')->nullable();
            $table->integer('idcriadopor')->nullable();
            $table->integer('arquivo_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefas');
    }
}
