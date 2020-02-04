<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartamentoLink extends Model
{
    public function links()
    {
        return $this->belongsTo('App\Link','link_id');
    }

    public function link()
    {
        return $this->belongsTo('App\Link','link_id');
    }
}
