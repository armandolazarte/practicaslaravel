<!--common.errors.blade.php = common.request.blade.php-->

@if (count($errors) > 0)
	<!-- Form Error List -->
	<div class="alert alert-danger">
		<strong>Por favor corrigir los siguientes errores:</strong>

		<br><br>

		<ul>
			@foreach ($errors->all() as $error)
				<li>{!! $error !!}</li>
			@endforeach
		</ul>
	</div>
@endif
