<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(EmpresasTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
		$this->call(NoticiasTableSeeder::class);
        $this->call(Departamento_NoticiaTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
