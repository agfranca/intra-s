<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class Tarefa extends Model
{
    //

   use SoftDeletes;
   use LogsActivity;

   protected $dates = ['deleted_at'];

   protected static $logAttributes = ['nome','descricao','entrega','anexo','prioridade','status','iddestino','idcriadopor','arquivo_id'];

   protected static $logOnlyDirty = true;
   protected static $logFillable = true;

   // Accessors Laravel campos inseridos depois do envio pelo Controler
   protected $appends = ['url_edit','color'];

   public function getUrlEditAttribute($value)
    {
      $id = $this->id;
      
      return '/edit/'.$id.'/recebidas';
    }

  public function getColorAttribute($value)
    {
      
      if ( $this->prioridade == "Baixa"){
        return 'blue';  
      }elseif ($this->prioridade == "Normal") {
        return 'green';
      }elseif ($this->prioridade == "Alta") {
        return 'red';
      }
    }

   public function project()
   {
     return $this->belongsTo('App\User','project_id');
   }

   public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }


    public function projecttype()
    {
        return $this->belongsTo('App\Projecttype');
    }




   public function criadopor()
   {
   	 return $this->belongsTo('App\User','idcriadopor');
   }

    public function destino()
   {
   	 return $this->belongsTo('App\User','iddestino');
   }

   public static function tarefascount()
    {
        //Variavel com ID do Usuário
        $idUsuario = Auth::user()->id;

        //Dados
        $tarefas = Tarefa::where('iddestino', '=', $idUsuario)
        ->join('users', 'tarefas.idcriadopor', '=', 'users.id')
        ->select('tarefas.*', 'users.name')
        ->get()
        ->count('id');
        //dd($tarefas);
        return $tarefas;

    }

    public static function tarefasdoprojeto($projeto)
    {
        //dd($projeto);
        $projetoenviado = Project::where('id', '=', $projeto)->first();
        //dd($projetoenviado);
        $tarefasdoprojeto = $projetoenviado->tarefa;
        return $tarefasdoprojeto;

    }
}
