<table id="listas" class="table table-hover table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nombre</th>
      <th>Sigla</th>
      <th>Nombre Corto</th>
      <th data-sortable="false" width="100px">Acciones</th>
    </tr>    
  </thead>
  <tbody>
    @foreach($areas as $cr => $area)
      <tr data-id="{!! $area->id !!}">
        <td>{!! $cr+1 !!}</td>
        <td>{!! $area->nombre !!}</td>
        <td>{!! $area->sigla !!}</td>
        <td>{!! $area->slug !!}</td>
        <td>
          <button type="button"
              data-href="{!! route('area.ajaxmodal.editar', [$area->id]) !!}"
              class="btn btn-info btn-sm"
              data-target="#crearEditar"
              data-toggle="modal"
              id="showModal"
              title="Actualizar">
            <i class="fa fa-edit"></i>
          </button>          
          <a data-href="{{ URL::to('admin/areasajaxmodal/eliminar/' . $area->id) }}"
              class="btn btn-danger confirmarEliminar"
              data-target="#modalEliminar"
              data-toggle="modal"
              title="Borrar-Solso">
            <i class="glyphicon glyphicon-trash"></i>
          </a>
        </td>
      </tr>
      @include('admin.modals.modal-delete', ['title' => 'Por favor confirmar'])
    @endforeach
  </tbody>
</table>