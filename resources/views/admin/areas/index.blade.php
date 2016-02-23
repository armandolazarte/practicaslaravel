@extends('layouts.app')

@section('title')
  Areas
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading">Áreas</div>
        <div class="panel-body">

          <!-- Visualizando los mensajes de error -->
          @include('common.errors')
          @include('common.success')          
          <div class="successMessages"></div>

          <a href="{{ route('admin.area.crear') }}" class="btn btn-primary btn-md pull-right fa fa-plus-circle"> Crear</a>

          <!-- Registros actuales -->
          @if (count($areas) > 0)
            @include('admin.areas._table')
          @endif
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection