@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Tareas</div>
        <div class="panel-body">

          <!-- Visualizando los mensajes de error -->
          @include('common.errors')

          <!-- CSRF Token -->
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

          <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Crear Tarea</button>
          <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tarea</th>
                  <th>Descripción</th>
                  <th>Fecha de Creada</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody id="tasks-list" name="tasks-list">
                @foreach ($tasks as $task)
                <tr id="task{{$task->id}}">
                  <td>{{$task->id}}</td>
                  <td>{{$task->task}}</td>
                  <td>{{$task->description}}</td>
                  <td>{{$task->created_at}}</td>
                  <td>
                    <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$task->id}}">Edit</button>
                    <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$task->id}}">Delete</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Editor de Tareas</h4>
                  </div>
                  <div class="modal-body">
                    <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                      <div class="form-group error">
                        <label for="inputTask" class="col-sm-3 control-label">Tarea</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control has-error" id="task" name="task" placeholder="Task" value="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Descripción</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Guardar cambios</button>
                    <input type="hidden" id="task_id" name="task_id" value="0">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  {!! Html::script('assets/js/plugins/ajax-crud.js') !!}
@endsection