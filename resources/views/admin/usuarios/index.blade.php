@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div id="validation" class="alert alert-danger" style="display: none">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <ul></ul>
        </div>

        <div id="users-form">
          @include('admin.usuarios.create')
        </div>
      </div>
    </div>

    <hr/>

    <div class="row">
      <div class="col-lg-12">
        <table id="userstable" class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Identificación</th>
              <th>Nombres</th>
              <th>Correo Electrónico</th>
              <th>Nombre Corto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="displayusuarios">
            @foreach($usuarios as $usuario)
            <tr>
              <td>{{ $usuario->id }}</td>
              <td>{{ $usuario->identificacion }}</td>
              <td>{{ $usuario->nombres }}</td>
              <td>{{ $usuario->email }}</td>
              <td>{{ $usuario->slug }}</td>
              <td>
                <a id="edit-user" class="btn btn-info" href="{{ URL::to('usuarios/'.$usuario->id.'/edit/') }}">
                  <span class="glyphicon glyphicon-edit"></span> Editar
                </a>

                <div style="display: inline-block">
                  {!! Form::open([
                      'method' => 'delete',
                      'action' => ['Admin\UsuarioController@destroy', $usuario->id],
                      'id' => 'delete-form'
                    ])
                  !!}
                    <button class="btn btn-danger deleteuser" type="submit">
                      <span class="glyphicon glyphicon-trash"></span> Eliminar
                    </button>
                  {!! Form::close() !!}
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection