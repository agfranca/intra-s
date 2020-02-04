<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjecttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projecttypes', function (Blueprint $table) {
            $table->softDeletes();
            $table->increments('id');
            $table->string('nome')->nullable();
            $table->longText('descricao')->nullable();
            $table->longText('campos')->nullable();
            $table->boolean('combo');
            $table->integer('departamento_id')->unsigned();
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
        Schema::dropIfExists('projecttypes');
    }
}
