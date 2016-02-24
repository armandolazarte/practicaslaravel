<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>SiEquipos | @yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet" type="text/css">

    <!-- Hojas de Estilos -->
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/LobiBox.min.css') !!}
    {!! Html::style('assets/css/jquery.dataTables.min.css') !!}
    {!! Html::style('assets/css/jquery.growl.css') !!}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>

<body>
<div class="container">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Practicas Lrvl-5.1</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Estudiantes</a>
                    <li><a href="{{ url('tasks') }}">Tareas</a>
                    <li><a href="{{ url('usuarios') }}">Usuarios</a>
                    <li><a href="{{ url('admin/areas') }}">Áreas</a>
                    <li><a href="{{ url('admin/areasajax') }}">Áreas Con Ajax</a>
                    <li><a href="{{ url('admin/areasajaxmodal') }}">Áreas Ajax Modal</a>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</div>

@include('common.success-request-ajax')
@include('common.errors-request-ajax')

@yield('content')

        <!-- Scripts -->
{!! Html::script('assets/js/jquery-2.2.0.min.js') !!}
{!! Html::script('assets/js/bootstrap.min.js') !!}
{!! Html::script('assets/js/lobibox.min.js') !!}
{!! Html::script('assets/js/jquery.dataTables.min.js') !!}
{!! Html::script('assets/js/jquery.growl.js') !!}
{!! Html::script('assets/js/plugins/ajax-usuarios.js') !!}

@yield('scripts')

<script>
    $('div.alert').not('.alert-important').delay(3000).slideUp(300);
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#listas').DataTable(
                {
                    "order": [[0, 'asc']],

                    "language": {
                        "processing": "Procesando...",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "zeroRecords": "No se encontraron resultados",
                        "emptyTable": "Ningún dato disponible en esta tabla",
                        "info": "Registros del _START_ al _END_ de _TOTAL_",
                        "infoEmpty": "Mostrando registros del 0 al 0 de 0 registros",
                        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "infoPostFix": "",
                        "search": "Buscar:",
                        "url": "",
                        "infoThousands": ",",
                        "loadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
    });
</script>
</body>
</html>