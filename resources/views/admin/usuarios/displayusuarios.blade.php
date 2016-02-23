@foreach($usuarios as $usuario)
  <tr>
    <td>{{ $usuario->id }}</td>
    <td>{{ $usuario->identificacion }}</td>
    <td>{{ $usuario->nombres }}</td>
    <td>{{ $usuario->email }}</td>
    <td>{{ $usuario->slug }}</td>
    <td>
      <a id="edit-user" class="btn btn-info" href="{{ URL::to('usuarios/'.$usuario->id.'/edit/')}}">
        <span class="glyphicon glyphicon-edit"></span> Editar
      </a>


    </td>
  </tr>
@endforeach
