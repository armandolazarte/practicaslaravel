@extends('layouts.app')

@section('title', 'Areas')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Lista de Áreas</div>
          <div class="panel-body">

            <!-- Visualizando los mensajes de error -->
            @include('common.errors')
            @include('common.success')
            <div class="successMessages"></div>
            
            <button type="button"
                data-href="{{ URL::to('admin/areasajaxmodal/crear')}}"
                class="btn btn-primary btn-md pull-right"
                id="showModal"
                data-toggle="modal"
                data-target="#crearEditar">
              <i class="fa fa-plus-circle"></i> Crear
            </button>

            <!-- Registros actuales -->
            @if (count($areas) > 0)
              @include('admin.areasAjaxModal._table')
            @endif
            
            @include('admin.modals.modal-crud')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  {!! Html::script('assets/js/plugins/ajax-modal.js') !!}
@endsection