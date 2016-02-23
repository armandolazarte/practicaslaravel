<table class="table table-striped task-table">
  <thead>
    <th>Nombre</th>
    <th>Sigla</th>
    <th>Nombre Corto</th>
    <th>Acciones</th>
  </thead>
  <tbody>              
    @foreach($areas as $area)
      <tr>
        <td class="table-text"><div>{!! $area->nombre !!}</div></td>
        <td class="table-text"><div>{!! $area->sigla !!}</div></td>
        <td class="table-text"><div>{!! $area->slug !!}</div></td>
        <td>
          <a href="{!! route('admin.area.editar', [$area->id]) !!}">
            <button class="btn btn-social-icon btn-info" type="button" title="Actualizar">
              <i class="fa fa-edit"></i>
            </button>
          </a>
          {!! Form::model($area, [
                'route'  => ['admin.area.eliminar', $area->id],
                'method' => 'DELETE',
                'role'   => 'form',
                'style'  => 'display:inline'
              ])
          !!}
            <button class="btn btn-social-icon btn-danger" type="submit" title="Eliminar">
              <i class="fa fa-trash"></i>
            </button>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>