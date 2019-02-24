<?php
use App\Departamento_Noticia;
use Illuminate\Database\Seeder;

class Departamento_NoticiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Departamento_Noticia::truncate();

        $DNA1 = new Departamento_Noticia;
        $DNA1->departamento_id = 2;
        $DNA1->noticia_id = 1;
        $DNA1->empresa_id = 2;
		$DNA1->user_id = 1;
        $DNA1->save();


        $DNA2 = new Departamento_Noticia;
        $DNA2->departamento_id = 2;
        $DNA2->noticia_id = 2;
        $DNA2->empresa_id = 2;
		$DNA2->user_id = 1;
        $DNA2->save();


        $DNA3 = new Departamento_Noticia;
        $DNA3->departamento_id = 2;
        $DNA3->noticia_id = 3;
        $DNA3->empresa_id = 2;
        $DNA3->user_id = 1;
		$DNA3->save();

        $DNA4 = new Departamento_Noticia;
        $DNA4->departamento_id = 2;
        $DNA4->noticia_id = 3;
        $DNA4->empresa_id = 2;
        $DNA4->user_id = 1;
		$DNA4->save();
    }
}
