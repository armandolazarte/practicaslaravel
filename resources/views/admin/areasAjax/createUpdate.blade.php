@extends('layouts.app')

<?php
  if ($area->exists):
    $form_data = ['route' => ['area.ajax.actualizar', $area->id], 'method' => 'PATCH', 'id' => 'formulario', 'class' => 'form-horizontal panel'];
    $action = ' Editar';
  else:
    $form_data = ['url' => ['admin/areasajax'], 'method' => 'POST', 'id' => 'formulario', 'class' => 'form-horizontal panel'];
    $action = ' Crear';
  endif;
?>

@section('title')
  {{ $action }} Areas
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">{{ $action }} Área</div>
          <div class="panel-body">
                          
            <!-- Visualizando los mensajes de error - Generales y Crear/Actualizar -->
            {{-- @include('common.errors') --}}
            <div class="successMessages"></div>
            
            {!! Form::model($area, $form_data) !!}
              {!! csrf_field() !!}
              
              @include('admin.areasAjax._fields')
              
              <div class="form-group" align="center">
                {!! Form::button($action . ' Área', [
                    'type'  => 'submit',
                    'class' => 'btn btn-primary btn-md fa fa-plus-circle',
                    'id'    => 'btn-form'
                  ])
                !!}
                <button type="reset" class="btn btn-success fa fa-refresh"> Limpiar</button>
                 <a href="{{ url('admin/areasajax') }}" class="btn btn-warning glyphicon glyphicon-backward"> Volver</a>
              </div>
              
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  {!! Html::script('assets/js/plugins/ajax-registros.js') !!}
@endsection