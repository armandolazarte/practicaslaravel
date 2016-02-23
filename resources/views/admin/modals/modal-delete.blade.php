{{-- Confirmar Eliminar Registro --}}
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="confirmation-modal-title">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{ $title }}</h4>
			</div>
			<div class="modal-body">
        <p class="lead">
          Esta seguro de eliminar el registro&nbsp;<i class="fa fa-question-circle fa-lg"></i>
        </p>
      </div>
			<div class="modal-footer">
        {!! Form::open(['id' => 'eliminarForm']) !!}
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-danger eliminarReg"
                data-message-title="Notificación de eliminación"
                data-message-success="El registro fue eliminado.">
            <i class="fa fa-times-circle"></i>  Sí, Eliminar
          </button>
        {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>