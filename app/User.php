<?php

namespace App;
use App\Departamento;
use App\Tarefa;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'departamentos_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function habilitaradm($usuario)
    {
        //dd($usuario);
        $usuario -> assignRole ('Admin');
        $usuario->syncRoles('Admin');
    }

    public static function habilitaradmsetor($usuario)
    {
        //dd($usuario);
        $usuario -> assignRole ('AdminSetor');
        $usuario->syncRoles('AdminSetor');
    }

    public static function desabilitaradm($usuario)
    {
        //$usuario->removeRole('Admin');
        $usuario -> assignRole ('User');
        $usuario->syncRoles('User');

    }

    public function noticia()
    {
      return $this->hasMany('App\Noticia');
    }

     public function tarefasUsuario()
    {
        return $this->hasMany('App\Tarefa', 'iddestino');
    }

    public function departamento_noticias()
    {
      return $this->hasMany('App\Noticia');
    }

    public function noticias()
    {
        $departamento = auth()->user()->departamentos_id;

        $noticias = DB::table('noticias')
                            ->join('departamento__noticias','noticias.id','=','departamento__noticias.noticias_id')
                            ->select('noticias.*','departamento__noticias.departamentos_id')
                            ->where('departamento__noticias.departamentos_id','=',2);
        
        return $noticias;

    }

     public function departamento()
    {
        return $this->belongsTo('App\Departamento');
    }


     public function arquivo()
    {
        return $this->belongsTo('App\Arquivo');
    }


    public static function users_painel()
    {

        //retorna o departamento do usuario logado
        $departamento_id = Auth::user()->departamento_id;
        //dd($departamento_id);
        $empresa_id = Departamento::where('id',$departamento_id)->get()->first(); 
        //dd($empresa_id);
        //retorna o objeto empresa do usuario logado
        $empresa = Empresa::where('id',$empresa_id->empresa_id)->get()->first();   
        //dd($empresa);
        //retorna os departamentos da empresa
        $departamentos = $empresa->departamentos;
        //listar os usuários de cada departamento da empresa
        $todosusuarios = collect([]);
        $usuarios = collect([]);

        foreach ($departamentos as $departamento) {

            $usuarios = $departamento->user;
            //dd($departamento);

            //dd($usuarios);    

            //dd($usuarios);
           // $todosusuarios= array_merge($todosusuarios->toArray(),$usuarios->toArray());
            $todosusuarios = $todosusuarios->merge($usuarios);
        }
        //dd($todosusuarios);
        //retorna as empresas filhos da empresa emviada    
        $filhos = Empresa::empresasfilhos($empresa->id);

        foreach ($filhos as $filho) {
            $departamentosfilhos = $filho->departamentos;
        //listar os usuários de cada departamento da empresa

            foreach ($departamentosfilhos as $departamento) {

                $usuariosfilhos = $departamento->user;

                $todosusuarios = $todosusuarios->merge($usuariosfilhos);            
            }
        }
            return $todosusuarios;
    }

    public static function users_painel_tree()
    {
        //retorna o id do departamento do usuario logado
        $departamentos_id = Auth::user()->departamento_id;

        //Retorna o departamento do usuário logado
        $departamento_usuario = DB::table('departamentos')->where('id',$departamentos_id)->first();


        if (Auth::user()-> hasRole ( 'AdminSetor' )) {
            
        //dd('Cheguei aqui!!!!');

        $teste=Departamento::listardepartamentoefilhos($departamento_usuario);

       //dd($teste);
        return $teste;

        }
        
            //Retorna o id da empresa do usuario logado
        $empresa_id = $departamento_usuario->empresa_id;  

        //Lista as Empresas da empresa do Usuario Logado
        $teste=Empresa::listarempresasdepartamentos(Empresa::listarempresa($empresa_id));

       //dd($teste);
        return $teste;
    }

}
    