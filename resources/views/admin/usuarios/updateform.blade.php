{!! Form::open([
    'method' => 'PATCH',
    'action' => ['Admin\UsuarioController@update', $usuario->id],
    'id' => 'user-update'
  ])
!!}

  <div class="successMessages"></div>
  
  <div class="col-xs-5">
    <div class="form-group">
      {!! Form::label('Identificacion') !!}
      {!! Form::text('identificacion', $usuario->identificacion, ['class' => 'form-control', 'id' => 'identificacion']) !!}
      <div class="text-danger" id="identificacion_error"></div>
    </div>
    <div class="form-group">
      {!! Form::label('Nombres') !!}
      {!! Form::text('nombres', $usuario->nombres, ['class' => 'form-control', 'id' => 'nombres']) !!}
      <div class="text-danger" id="nombres_error"></div>
    </div>
    <div class="form-group">
      {!! Form::label('Correo Electrónico') !!}
      {!! Form::email('email', $usuario->email, ['class' => 'form-control', 'id' => 'email']) !!}
      <div class="text-danger" id="email_error"></div>
    </div>
    <div class="form-group">
      {!! Form::label('Nombre Corto') !!}
      {!! Form::text('slug', $usuario->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
      <div class="text-danger" id="slug_error"></div>
    </div>

    <div class="form-group">
      <button class="btn btn-success">
        <span class="glyphicon glyphicon-edit"></span> Actualizar Usuario
      </button>
    </div>
  </div>

{!! Form::close() !!}