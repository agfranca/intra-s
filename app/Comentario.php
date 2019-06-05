<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Comentario extends Model
{
    use SoftDeletes;
    use LogsActivity;
 
    /**
     * Opcional, informar a coluna deleted_at como um Mutator de data
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected static $logAttributes = ['comentario'];

    public function usuario()
    {
      return $this->hasOne('App\User','users_id');
       
    }
}
