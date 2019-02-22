<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner_Departamento extends Model
{
    public static function bannersdodepartamento($id)
   {
   		$todosbanners = Banner_Departamento::where('departamento_id',$id)->get();

   		return $todosbanners;  


   }
}
