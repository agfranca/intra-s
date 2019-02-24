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
        $EmpresaA->nome = 'Raiz';
        $EmpresaA->save();

        $EmpresaB = new Empresa;
        $EmpresaB->nome = 'FECOMERCIO SE';
        $EmpresaB->empresa_pai = 1;
        $EmpresaB->save();
    }
}
