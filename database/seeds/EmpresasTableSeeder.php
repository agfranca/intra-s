<?php
use App\Empresa;
use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Empresa::truncate();

        $EmpresaA = new Empresa;
        $EmpresaA->nome = 'FECOMÉRCIO SE';
        $EmpresaA->save();

        $EmpresaB = new Empresa;
        $EmpresaB->nome = 'SENAC SE';
        $EmpresaB->empresa_pai = 1;
        $EmpresaB->save();
    }
}
