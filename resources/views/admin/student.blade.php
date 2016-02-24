@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Estudiantes</div>
                <div class="panel-body">

                    <!-- Visualizando los mensajes de error -->
                    {{--@include('common.errors')--}}
                    <div class="alert alert-danger" role="alert" id="errorForm" style="display: none">
                        <b>Por favor corrige los siguentes errores:</b>
                        <ul></ul>
                    </div>

                    <form action="" id="formStudent" method="POST">
                        <!-- CSRF Token -->
                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">--}}
                        {!! csrf_field() !!}

                        <input type="hidden" id="id" name="id">

                        <div class="form-group">
                            <label for="student_name">Nombre del Estudiante</label>
                            <input name="student_name" type="text" id="student_name" class="form-control" placeholder="Ingrese el nombre completo">
                        </div>
                        <div class="form-group">
                            <label for="gender">Género</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="">Seleccione el Género</option>
                                <option value="0">Masculino</option>
                                <option value="1">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Teléfono</label>
                            <input name="phone" type="text" id="phone" class="form-control" placeholder="Ingrese el teléfono">
                        </div>

                        <div class="box-footer">
                            <button type="button" id="newrecord"class="btn btn-primary">Nuevo</button>
                            <button type="button" id="saverecord" class="btn btn-primary">Guardar</button>
                            <button type="button" id="updaterecord" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>

                    <!-- Visualizar los datos -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Listado de Estudiantes</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre Completo</th>
                                        <th>Género</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="displayrecord"></tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Fin Visualizar los datos -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            //$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('#token').val()} });
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            // alert(0);

            displaydata();

            $('#newrecord').click(function(e) {
                e.preventDefault();

                cleardata();
            });

            //$('.saverecord').click(function() {
            $('#saverecord').click(function(e) {
                e.preventDefault();

                // alert('Botón saverecord');
                //var studentname = $('#student_name').val();
                //var gender      = $('#gender').val();
                //var phone       = $('#phone').val();

                var url = "{{ url('save') }}";
                var form = $('#formStudent');
                var data = form.serialize();
                var error = $('#errorForm');

                $.ajax({
                    url: url,
                    data: data,
                    type: "POST",
                    dataType : "json",
                    success: function(response) {
                        cleardata();

                        Lobibox.notify('success', {
                            title: 'Éxito',
                            msg: 'Estudiante creado satisfactoriamente',
                            position: 'top right',
                            showClass: 'fadeInDown',
                            hideClass: 'fadeUpDown',
                            width: 400,
                            delay: 5000,
                            sound: false,
                        });

                        displaydata();
                    },
                    error: function(response) {
                        if(response.status == 422) {
                            var errors = $.parseJSON(response.responseText);

                            error.hide().find('ul').empty();

                            $.each(errors, function(index, value) {
                                error.find('ul').append('<li>' + value + '</li>');
                            });

                            error.slideDown();
                        }
                    },
                    complete: function(response) {
                    }
                });

                /*$.ajax(
                {
                    url     : "<?=URL::to('save')?>", //$(this).attr('action'),
                    type    : "POST",
                    // async   : false,
                    data    : {
                        'studentname' : studentname,
                        'gender'      : gender,
                        'phone'       : phone
                    },
                    success : function(re)
                    {
                        // alert(re);
                        if (re === 0)
                        {
                            alert('0 === Error al guardar.');
                        }
                        else {
                            alert('1 === Guardado exitosamente.');
                            displaydata();
                        }
                    }
                }); //Fin ajax*/
            }); //Fin saverecord


            // Editar un estudiante
            $('body').on('click', '.editar', function(e) {
                e.preventDefault();

                var url = "{{ url('editrow') }}";
                var id = $(this).data('id');
                var data = {'id' : id}

                $.post(url, data, function(response) {
                    $.each(response, function(index, value) {
                        $('input[name="' + index + '"]').val(value);
                        $('select option[value="' + value + '"]').prop('selected', true);
                    });
                });
            });

            /*$('body').delegate('.editar', 'click', function()
            {
                var id = $(this).data('id');
                // alert(id);

                $.ajax(
                {
                    url     : "<?=URL::to('editrow')?>",
                    type    : "POST",
                    // async   : false,
                    data    : {
                        'id' : id
                    },
                    success : function(e)
                    {
                        // alert(e);
                        $('#id').val(e.id);
                        $('#student_name').val(e.student_name);
                        $('#gender').val(e.gender);
                        $('#phone').val(e.phone);
                    }
                }); //Fin ajax
            });*/

            // Actualizar estudiante
            $('#updaterecord').click(function(e) {
                e.preventDefault();

                var url = "{{ url('update') }}";
                var form = $('#formStudent');
                var data = form.serialize();
                var error = $('#errorForm');

                $.ajax({
                    url: url,
                    data: data,
                    type: "POST",
                    dataType : "json",
                    success: function(response) {
                        cleardata();

                        Lobibox.notify('success', {
                            title: 'Éxito',
                            msg: 'Estudiante actualizado satisfactoriamente',
                            position: 'top right',
                            showClass: 'fadeInDown',
                            hideClass: 'fadeUpDown',
                            width: 400,
                            delay: 5000,
                            sound: false,
                        });

                        displaydata();
                    },
                    error: function(response) {
                        if(response.status == 422) {
                            var errors = $.parseJSON(response.responseText);

                            error.hide().find('ul').empty();

                            $.each(errors, function(index, value) {
                                error.find('ul').append('<li>' + value + '</li>');
                            });

                            error.slideDown();
                        }
                    },
                    complete: function(response) {
                    }
                });
            });

            /*$('#updaterecord').click(function()
            {
                var id          = $('#id').val();
                var studentname = $('#student_name').val();
                var gender      = $('#gender').val();
                var phone       = $('#phone').val();

                $.ajax(
                {
                    url     : "<?=URL::to('update')?>", //$(this).attr('action'),
                    type    : "POST",
                    // async   : false,
                    data    : {
                        'id'          : id,
                        'studentname' : studentname,
                        'gender'      : gender,
                        'phone'       : phone
                    },
                    success : function(re)
                    {
                        // alert(re);
                        if (re === 0)
                        {
                            alert('0 === Error al actualizar.');
                        }
                        else {
                            alert('1 === Actualizado exitosamente.');
                            displaydata();
                        }
                    }
                }); //Fin ajax
            }); //Fin updaterecord*/


            // Eliminar usuario
            $('body').on('click', '.eliminar', function(e) {
                e.preventDefault();

                var url = "{{ url('deleterow') }}";
                var id = $(this).data('id');
                var data = {'id' : id};

                Lobibox.confirm({
                    title: 'Eliminar',
                    msg: "Seguro que quieres eliminar este estudiante?",
                    callback: function ($this, type, ev) {
                        if (type === 'yes') {
                            $.post(url, data, function() {
                                Lobibox.notify('success', {
                                    title: 'Éxito',
                                    msg: 'Estudiante eliminado satisfactoriamente',
                                    position: 'top right',
                                    showClass: 'fadeInDown',
                                    hideClass: 'fadeUpDown',
                                    width: 400,
                                    delay: 5000,
                                    sound: false,
                                });

                                displaydata();
                            });
                        } else if (type === 'no') {

                        }
                    }
                });
            });

            /*$('body').delegate('.eliminar', 'click', function()
            {
                var id = $(this).data('id');
                // alert(id);

                $.ajax(
                {
                    url     : "<?=URL::to('deleterow')?>",
                    type    : "POST",
                    // async   : false,
                    data    : {
                        'id' : id
                    },
                    success : function(d)
                    {
                        if (d === 0)
                        {
                            alert('Error al eliminar');
                        } else {
                            alert('Se eliminó el registro.');
                            displaydata();
                        }
                    }
                }); //Fin ajax
            });*/
        }); //function()

        // Limpiar Campos
        function cleardata() {
            $('#errorForm').hide().find('ul').empty();
            $(':input').not('input[name="_token"]').val('');
            //$('#formStudent')[0].reset();
            //$('#id').val('');
        }

        // Visuaizar los datos
        function displaydata() {
            var url = "{{ url('showdata') }}";

            $.post(url, null, function(response) {
                $('#displayrecord').html(response);
            });
        }

        /*function displaydata()
        {
            $.ajax(
            {
                url     : "<?=URL::to('showdata')?>", //$(this).attr('action'),
                type    : "POST",
                // async   : false,
                data    : {
                    'showrecord' : 1
                },
                success : function(s)
                {
                    // alert(s);
                    $('.displayrecord').html(s);
                }
            }); //Fin ajax
        }*/
    </script>
@endsection