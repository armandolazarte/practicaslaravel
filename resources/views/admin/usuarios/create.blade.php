{!! Form::open([
    'method' => 'POST',
    'action' => 'Admin\UsuarioController@store',
    'id' => 'create-form'
  ])
!!}
  
  <div class="successMessages"></div>
  <div class="errorMessages"></div>
  
  <div class="col-xs-5">
    <div class="form-group">
      {!! Form::label('Identificacion') !!}
      {!! Form::text('identificacion', null, ['class' => 'form-control', 'id' => 'identificacion']) !!}
      <div class="text-danger" id="identificacion_error"></div>
    </div>
    <div class="form-group">
      {!! Form::label('Nombres') !!}
      {!! Form::text('nombres', null, ['class' => 'form-control', 'id' => 'nombres']) !!}
      <div class="text-danger" id="nombres_error"></div>
    </div>
    <div class="form-group">
      {!! Form::label('Correo Electrónico') !!}
      {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
      <div class="text-danger" id="email_error"></div>
    </div>
    <div class="form-group">
      {!! Form::label('Nombre Corto') !!}
      {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
      <div class="text-danger" id="slug_error"></div>
    </div>

    <div class="form-group">
      <button class="btn btn-primary">
        <span class="glyphicon glyphicon-share"></span> Crear Usuario
      </button>
    </div>
  </div>
{!! Form::close() !!}