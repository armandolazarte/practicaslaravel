<table id="listas" class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Sigla</th>
      <th>Nombre Corto</th>
      <th data-sortable="false" width="100px">Acciones</th>
    </tr>    
  </thead>
  <tbody>
    @foreach($areas as $area)
    <tr data-id="{!! $area->id !!}">
        <td>{!! $area->nombre !!}</td>
        <td>{!! $area->sigla !!}</td>
        <td>{!! $area->slug !!}</td>
        <td>
          <a href="{!! route('area.ajax.editar', [$area->id]) !!}">
            <button class="btn btn-sm btn-info" type="button" title="Actualizar">
              <i class="fa fa-edit"></i>
            </button>
          </a>
          <a href="#">
            <button class="btn btn-social-icon btn-danger" type="submit" title="Eliminar">
              <i class="fa fa-trash"></i>
            </button>
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>