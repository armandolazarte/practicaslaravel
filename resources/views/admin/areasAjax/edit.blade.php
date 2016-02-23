@extends('layouts.app')

@section('title')
  Editar Areas
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Editar Área</div>
          <div class="panel-body">
            
            <!-- Visualizando los mensajes de error - Generales y Crear/Actualizar -->
            {{-- @include('common.errors') --}}
            <div class="successMessages"></div>
            
            {!! Form::model($area, [
                'url'  => ['admin/areasajax', $area->id],
                'method' => 'PATCH',
                'class'  => 'form-horizontal',
                'id'     => 'editForm'])
            !!}
              {!! csrf_field() !!}
              
              <div class="box-body">
                <div class="form-group">
                  {!! Form::label('nombre', 'Nombre: *', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-9">
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => '60']) !!}
                    <div class="text-danger" id="nombre_error"></div>
                  </div>  
                </div>

                <div class="form-group">
                  {!! Form::label('sigla', 'Sigla: *', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-2">
                    {!! Form::text('sigla', null,
                    [
                    'class' => 'form-control',
                    'maxlength' => '4',
                    'onkeyup' => 'this.value=this.value.toUpperCase()'
                    ])
                    !!}
                  </div>
                    <div class="text-danger" id="sigla_error"></div>
                </div>
              </div>

              <div class="form-group">
                <button class="btn btn-success" id="btn-form">
                  <span class="glyphicon glyphicon-edit"></span> Actualizar
                </button>
              </div>
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(function(){

      $.ajaxSetup({
          headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });

      editUsingAjax();

    });

    function editUsingAjax()
    {
      $('#btn-form').click(function(event)    //edit
      {
        event.preventDefault();
        
        var formId = '#editForm';
        
        $.ajax(
        {
          url     : $(formId).attr('action'),
          type    : $(formId).attr('method'),
          data    : $(formId).serialize(),
          dataType: 'json',
          success : function(data)
          {
            if (data.success)
            {
//              redirectPage(data);
              $('.successMessages').append('<div class="alert alert-success">' + data.messages + '</div>');
            }
            else {
              console.log(data);

              $.each(data.messages, function(index, value)
              {            
                //Funciona agregando en el form => <div class="text-danger" id="nombreCampo_error"></div>
                var errorDiv = '#'+index+'_error';
                $(errorDiv).addClass('has-error');
                $(errorDiv).empty().append(value);
                console.error(index+': '+value);
              });
            }
          }   //Fin success
        });   //Fin ajax()
      });
    }
  </script>
@endsection