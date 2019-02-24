<?php
use App\Noticia;
use Illuminate\Database\Seeder;

class NoticiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Noticia::truncate();

        $NoticiaA = new Noticia;
        $NoticiaA->titulo = 'Semana Pedagógica Senac 2018 é finalizada com sucesso';
        $NoticiaA->noticia = 'http://www.se.senac.br/destaque/semana-pedagogica-senac-2018-e-finalizada-com-sucesso';
        $NoticiaA->user_id = 1;
        $NoticiaA->save();

        $NoticiaB = new Noticia;
        $NoticiaB->titulo = 'Senac e aluno recebem Prêmio IEL de Estágio';
        $NoticiaB->noticia = 'http://www.se.senac.br/noticias/senac-e-aluno-recebem-premio-iel-de-estagio';
        $NoticiaB->user_id = 1;
        $NoticiaB->save();

        $NoticiaC = new Noticia;
        $NoticiaC->titulo = 'Senac: encaminhando talentos para o mercado de trabalho';
        $NoticiaC->noticia = 'http://www.se.senac.br/noticias/senac-encaminhando-talentos-para-o-mercado-de-trabalho';
        $NoticiaC->user_id = 2;
        $NoticiaC->save();


    }
}
