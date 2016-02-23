@extends('layouts.app')

<?php
  if ($area->exists):
    $form_data = ['route' => ['admin.area.actualizar', $area->id], 'method' => 'PATCH', 'class' => 'form-horizontal panel'];
    $action = ' Editar';
  else:
    $form_data = ['url' => ['admin/areas'], 'method' => 'POST', 'id' => 'crearForm', 'class' => 'form-horizontal panel'];
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
          <div class="panel-heading">{{ $action }} Áreas</div>
          <div class="panel-body">
            
            {!! Form::model($area, $form_data) !!}
              {!! csrf_field() !!}
              
              <!-- Visualizando los mensajes de error - Generales y Crear/Actualizar -->
              {{-- @include('common.errors') --}}
              
              @include('admin.areas._fields')
              
              <div class="form-group" align="center">
                {!! Form::button($action . ' Área', [
                    'type'  => 'submit',
                    'class' => 'btn btn-primary btn-md fa fa-plus-circle'
                  ])
                !!}
                @if ($action === ' Editar')
                  {!! Form::model($area, ['route' => ['admin.area.eliminar', $area->id], 'method' => 'DELETE', 'role' => 'form']) !!}
                    <button type="submit" class="btn btn-danger fa fa-trash"> Eliminar</button>
                  {!! Form::close() !!}
                @endif
                <button type="reset" class="btn btn-success fa fa-refresh"> Limpiar</button>
                <a href="{{ url('admin/areas') }}" class="btn btn-danger glyphicon glyphicon-backward"> Volver</a>
              </div>
            {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection