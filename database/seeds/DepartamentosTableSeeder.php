<?php
use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::truncate();

        $DepartamentoA = new Departamento;
        $DepartamentoA->nome = 'Núcleo de Comunicação';
        $DepartamentoA->empresa_id = 1;
        $DepartamentoA->save();

        $DepartamentoB = new Departamento;
        $DepartamentoB->nome = 'Informática';
        $DepartamentoB->empresa_id = 2;
        $DepartamentoB->save();

        $DepartamentoC = new Departamento;
        $DepartamentoC->nome = 'Financeiro';
        $DepartamentoC->empresa_id = 2;
        $DepartamentoC->save();
    }
}
