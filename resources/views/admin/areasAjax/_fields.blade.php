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