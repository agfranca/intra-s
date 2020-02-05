<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectidTableTarefas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarefas', function (Blueprint $table) {
            $table->integer('project_id')->nullable();
            $table->integer('projecttype_id')->nullable();
            $table->integer('departamento_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('project_id');
        $table->dropColumn('projecttype_id');
        $table->dropColumn('departamento_id');
    }
}
