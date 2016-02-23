<?php
  if ($area->exists):
    $form_data = ['route' => ['area.ajax.actualizar', $area->id], 'method' => 'PATCH', 'id' => 'formRegistros', 'class' => 'form-horizontal panel'];
    $action = ' Editar';
  else:
    $form_data = ['url' => ['admin/areasajaxmodal'], 'method' => 'POST', 'id' => 'formRegistros', 'class' => 'form-horizontal panel'];
    $action = ' Crear';
  endif;
?>

@section('title')
  {{ $action }} Areas
@endsection

{!! Form::model($area, $form_data) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="panel-heading"><h4><i>{{ $action }} Área</i></h4></div>

  <div class="box-body">
    <div class="form-group">
      {!! Form::label('nombre', 'Nombre: *', ['class' => 'col-sm-2 control-label']) !!}
      <div class="col-sm-9">
        {!! Form::text('nombre', null, ['class' => 'form-control auto-focus', 'maxlength' => '60', 'autofocus']) !!}
        <div class="text-danger" id="nombre_error"></div>
      </div>  
    </div>

    <div class="form-group">
      {!! Form::label('sigla', 'Sigla: *', ['class' => 'col-sm-2 control-label']) !!}
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

    <div class="form-group" align="center">
      {!! Form::button($action . ' Área', [
          'type'  => 'submit',
          'class' => 'btn btn-primary btn-md fa fa-save'
        ])
      !!}
      <button type="reset" class="btn btn-success fa fa-refresh"> Limpiar</button>
      <a href="{{ url('admin/areasajaxmodal') }}" class="btn btn-warning glyphicon glyphicon-backward"> Volver</a>
    </div>
  </div>
{!! Form::close() !!}

@section('scripts')
  {!! Html::script('assets/js/plugins/ajax-modal.js') !!}
@endsection