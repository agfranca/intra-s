<div class="col-md-12">
        <div class="modal fade pg-show-modal" id="adicionartarefas" tabindex="-1" role="dialog" aria-hidden="true"> 
          <div class="modal-dialog"> 
            <div class="modal-content"> 
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                                     

                <h4 class="modal-title">Cadastrar Tarefas</h4> 
              </div>                                 

              <div class="modal-body">
                {!! Form::open(['route' => 'painel.tarefas.store','method' => 'POST','class'=>'form-group']) !!} 

                <div class="form-group">
                  <input placeholder="Digite o Nome da Tarefa" name="tarefa" type="text" required class="form-control form">
                </div>
                
                <div class="form-group">
                  <textarea title="Descrição da Tarefa" class="form-control form" name="descricao" placeholder="Descrição da Tarefa"></textarea>
                </div>
                
                <div style="padding-left: 0px;" class="col-md-6">
                  
                  <div class="form-group">
                  <label class="control-label">Data de Entrega:</label>

                  <input placeholder="Digite a data de Entrega" type="date" name="entrega" class="form-control form">
                </div>

                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                  
                  <div class="form-group"> 
                  <label class="control-label" for="formInput146">Prioridade:</label>                                             

                  <select id="formInput146" class="form-control" name="prioridade"> 
                    <option>Baixa</option>                                                 

                    <option>Normal</option>                                                 

                    <option>Alta</option>                                                 
                  </select>
                </div>

                </div>  

                @role('Admin')
                <div style="padding-left: 0px;" class="col-md-6">
                {!! Form::label('departamento', 'Departamento:') !!}
                {!! Form::select('departamento', $departamentos, null, ['class' => 'form-control']) !!}
                </div>
                <div style="padding-right: 0px;" class="col-md-6">
                {!! Form::label('usuario', 'Colaborador:') !!}
                {!! Form::select('usuario', [], null, ['class' => 'form-control']) !!}
                </div>
                @endrole
                @role('User')
                <div class="form-group"> 

                {!! Form::label('colaborador', 'Colaborador:') !!}
                {!! Form::select('colaborador', $usuariosDepartamento, null, ['class' => 'form-control']) !!}

                  {{-- <label class="control-label" for="formInput192">Colaborador:</label>     

                  <select id="formInput192" class="form-control" name='colaborador'>
                   @foreach($usuariosDepartamento as $usuario)
                   <option>{{$usuario->name}}</option>
                   @endforeach                 
                 </select> --}}
               </div>
               @endrole

                

             </div>
             <div class="modal-footer"> 
              {!! Form::submit('Salvar', ['class' => 'btn btn-primary']); !!}
            </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>               
          </div> 
        </div>
      </div>                                                 
    </div>
</div>        
