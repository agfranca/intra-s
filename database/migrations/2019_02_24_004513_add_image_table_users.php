<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('arquivo_id');
		});
		
		Schema::table('users', function (Blueprint $table) {
        $table->integer('arquivo_id') // Nome da coluna
                    ->nullable() // Preenchimento não obrigatório
                    ->after('password'); // Ordenado após a coluna "password"
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('arquivo_id');
		});
    }
}
