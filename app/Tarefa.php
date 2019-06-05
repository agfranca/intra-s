<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
class Tarefa extends Model
{
    //

   use SoftDeletes;
   use LogsActivity;

   protected $dates = ['deleted_at'];

   protected static $logAttributes = ['nome','descricao','entrega','anexo','prioridade','status','iddestino','idcriadopor','arquivo_id'];

   protected static $logOnlyDirty = true;

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
}
