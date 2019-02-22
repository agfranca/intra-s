<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner__departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();
            $table->integer('departamento_id')->unsigned();  
            $table->integer('empresa_id')->unsigned();  
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
        Schema::dropIfExists('banner__departamentos');
    }
}
