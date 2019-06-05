<?php

namespace App;

use App\Arquivo;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Arquivo_Tarefas extends Model
{

use LogsActivity;

protected static $logAttributes = ['arquivos_id','tarefas_id'];
//Ligações
     public function arquivo()
    {
      return $this->hasOne('App\Arquivo', 'id', 'arquivos_id');
    }



}
