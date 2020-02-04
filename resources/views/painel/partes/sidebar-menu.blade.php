<style type="text/css">
    .skin-blue .sidebar-menu>li>.treeview-menu {
        
        background-color: transparent;
    }
</style>
  
  <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MÓDULOS</li>
        <!-- Optionally, you can add icons to the links -->
       {{--  <li ><a href={{ route('home') }}><i class="fa fa-home"></i> <span>Home</span></a></li> --}}
        <li {{request()->is('painel')?'class=active':''}}><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> <span>Painel</span></a></li>
        
        @role('Admin')
        
        <li {{request()->is('painel/usuarios*')?'class=active':''}}><a href={{ route('painel.usuarios.index') }}><i class="fa fa-users"></i> <span>Usuários</span></a></li>        
        <li {{request()->is('painel/empresas*')?'class=active':''}}><a href={{ route('painel.empresas.index') }}><i class="fa fa-briefcase"></i> <span>Empresas</span></a></li>
        <li {{request()->is('painel/departamentos*')?'class=active':''}}><a href={{ route('painel.departamentos.index') }}><i class="fa fa-id-card-o"></i> <span>Departamentos</span></a></li>
        <li {{request()->is('painel/noticias*')?'class=active':''}}><a href={{ route('painel.noticias.index') }}><i class="fa fa-newspaper-o"></i> <span>Notícias</span></a></li>
        <li {{request()->is('painel/banners*')?'class=active':''}}><a href={{ route('painel.banners.index') }}><i class="fa fa-picture-o"></i> <span>Banners</span></a></li>
        <li {{request()->is('painel/tarefas*')?'class=active':''}}><a href={{ route('painel.tarefas.recebidasTodas') }}><i class="fa fa-flag-o"></i> <span>Tarefas Pessoais</span></a></li>
        <li {{request()->is('painel/tarefas*')?'class=active':''}}><a href={{ route('painel.tarefas.recebidasTodasDepartamento') }}><i class="fa fa-flag-o"></i> <span>Tarefas Setor</span></a></li>

        <li {{request()->is('painel/links*')?'class=active':''}}><a href={{ route('painel.links.index') }}><i class="fa fa-link"></i> <span>Links</span></a></li>
        
        <li {{request()->is('painel/notificar*')?'class=active':''}}><a href={{ route('painel.notificar.index') }}><i class="fa fa-id-card-o"></i> <span>Notificar Departamento</span></a></li>

        <li {{request()->is('painel/notificar*')?'class=active':''}}><a href={{ route('painel.notificar.aprovadores') }}><i class="fa fa-id-card-o"></i> <span>Aprovar Notificação</span></a></li>
        @endrole
        
        @role('User')

        <li {{request()->is('painel/noticias*')?'class=active':''}}><a href={{ route('painel.noticias.index') }}><i class="fa fa-newspaper-o"></i> <span>Notícias</span></a></li>
        <li {{request()->is('painel/banners*')?'class=active':''}}><a href={{ route('painel.banners.index') }}><i class="fa fa-picture-o"></i> <span>Banners</span></a></li>
        <li {{request()->is('painel/tarefas*')?'class=active':''}}><a href={{ route('painel.tarefas.recebidasTodas') }}><i class="fa fa-flag-o"></i> <span>Tarefas</span></a></li>


        @endrole

        @role('AdminSetor')


        <li {{request()->is('painel/noticias*')?'class=active':''}}><a href={{ route('painel.noticias.index') }}><i class="fa fa-newspaper-o"></i> <span>Notícias</span></a></li>
        <li {{request()->is('painel/banners*')?'class=active':''}}><a href={{ route('painel.banners.index') }}><i class="fa fa-picture-o"></i> <span>Banners</span></a></li>
        <li {{request()->is('painel/tarefas*')?'class=active':''}}><a href={{ route('painel.tarefas.recebidasTodas') }}><i class="fa fa-flag-o"></i> <span>Tarefas</span></a></li>

        <li {{request()->is('painel/links*')?'class=active':''}}><a href={{ route('painel.links.index') }}><i class="fa fa-link"></i> <span>Links</span></a></li>


        
        
        @endrole

  </ul> 


  {{-- LINKS --}}
    @php
    use App\Link;
    use App\Empresa;
    //use App\DepartamentoLink;
    //use Illuminate\Support\Facades\Auth;
   /*
    $links3 = Link::whereNull('link_id')
        ->with('linksFilhos')
        ->get();  
*/        
    $links = Link::linksUsuarioLogado();
    //dd($links);
    //$links = DepartamentoLink::where('departamento_id',$departamento)->with('link')->get();
    //$links = $links2->where('link->link_id',null)->first();
    //dd($links2->link->nome);
    //dd($links); 
    //$teste = Link::linksCriadoPeloUsuarioLogado();

    //TODOS os LINKS quando For ADMIN
    //$teste = Empresa::EmpresasDepartamentosLista();
    //dd($teste);
    @endphp
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Menu Interno</li>
    @foreach ($links as $link)
        @if($link->link->link_id == null)
        <li class="treeview"><a href={{$link->link->link}}><span>{{ $link->link->nome }}</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
            
        <ul class="treeview-menu">
        @foreach ($link->link->linksFilhos as $linkFilho)
            @include('painel.partes.link_filho', ['link_filho' => $linkFilho])
        @endforeach
        </ul>
        </li>
        @endif
    @endforeach
</ul>

