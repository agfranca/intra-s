
  <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGAÇÃO</li>
        <!-- Optionally, you can add icons to the links -->
        <li ><a href={{ route('home') }}><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li {{request()->is('painel')?'class=active':''}}><a href={{ route('painel') }}><i class="fa fa-dashboard"></i> <span>Painel</span></a></li>
        
        @role('Admin')
        
        <li {{request()->is('painel/usuarios*')?'class=active':''}}><a href={{ route('painel.usuarios.index') }}><i class="fa fa-users"></i> <span>Usuários</span></a></li>        
        <li {{request()->is('painel/empresas*')?'class=active':''}}><a href={{ route('painel.empresas.index') }}><i class="fa fa-briefcase"></i> <span>Empresas</span></a></li>
        <li {{request()->is('painel/departamentos*')?'class=active':''}}><a href={{ route('painel.departamentos.index') }}><i class="fa fa-id-card-o"></i> <span>Departamentos</span></a></li>
        <li {{request()->is('painel/noticias*')?'class=active':''}}><a href={{ route('painel.noticias.index') }}><i class="fa fa-newspaper-o"></i> <span>Notícias</span></a></li>
        <li {{request()->is('painel/banners*')?'class=active':''}}><a href={{ route('painel.banners.index') }}><i class="fa fa-picture-o"></i> <span>Banners</span></a></li>
        <li {{request()->is('painel/tarefas*')?'class=active':''}}><a href={{ route('painel.tarefas.recebidasTodas') }}><i class="fa fa-flag-o"></i> <span>Tarefas</span></a></li>

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


        
        @endrole

  </ul> 