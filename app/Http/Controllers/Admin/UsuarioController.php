<?php

namespace Siequipos\Http\Controllers\Admin;

use Siequipos\Models\Usuario;
use Illuminate\Http\Request;
use Siequipos\Http\Requests;
use Siequipos\Http\Controllers\Controller;
use View;
use Response;
use Validator;
use Input;

class UsuarioController extends Controller
{
  public function index()
  {
    $usuarios = Usuario::all();
    return View::make('admin.usuarios.index', compact('usuarios'));
  }
  
  public function display()
  {
    if (\Request::ajax())
    {
      $usuarios = Usuario::all();

      $data = View::make('admin.usuarios.displayusuarios', compact('usuarios'))->render();

      return response()->json($data);
    }
  }
  
  public function create()
  {
    if (\Request::ajax())
    {
      $data = View::make('admin.usuarios.create')->render();
//      return response()->json($data);
      
      return Response::json($data);
    }else{
      return 'Error';
    }
  }
  
  /*
   * Crear -> Mensajes de error en bloque o general
   */
//  public function store(Request $request)
//  {
//    if ($request->ajax())
//    {
//      $this->validate($request, [
//          'identificacion' => 'required|unique:usuarios',
//          'nombres'        => 'required|min:3|max:20',
//          'email'          => 'required|email|unique:usuarios',
//          'slug'           => 'required|max:30|unique:usuarios'
//      ]);
//
//      $usuario = Usuario::create($request->all());
//
//      if ($usuario)
//      {
//        return response('success');
//      }else{
//        return response('fail');
//      }
//    }
//  }
  
  /*
   * Crear -> Mensajes de error por cada campo
   */
  public function store(Request $request)
  {
    if ($request->ajax())
    {
      // Validar el formulario
      $rules = [
          'identificacion' => 'required|numeric|unique:usuarios',
          'nombres'        => 'required|min:3|max:20',
          'email'          => 'required|email|unique:usuarios',
          'slug'           => 'required|max:30|unique:usuarios'
      ];
      
      $validation = Validator::make(Input::all(), $rules);
      
      //Si la validación falla, redirigir al formulario con los errores
      if ($validation->fails())
      {
        //Como ha fallado el formulario, devolvemos los datos en formato json
        return Response::json([
            'fail'     => true,
            'messages' => $validation->messages()
        ]);
      }
      else {
        Usuario::create($request->all());
        
        return Response::json([
            'success'  => true,
            'messages' => 'Registro creado.'
        ]);
      }
    }
  }
  
  public function edit($id)
  {
    if(\Request::ajax())
    {
      $usuario = Usuario::findOrfail($id);

      $data = view('admin.usuarios.updateform', compact('usuario'))->render();
      
      return Response::json($data);
    }
  }
  
//  /*
//   * Actualizar -> Mensajes de error en bloque o general
//   */  
//  public function update(Request $request, $id)
//  {
//    if ($request->ajax())
//    {
//      $this->validate($request, [
//          'identificacion' => 'required',
//          'nombres'        => 'required',
//          'email'          => 'required|email',
//          'slug'           => 'required'
//      ]);
//
//      $usuario = Usuario::findOrFail($id);
//
//      $usuario->fill($request->all());
//
//      if ($usuario->update())
//      {
//        return response('success');
//      } else {
//          return response('fail');
//      }
//    }
//  }
  
  /*
   * Actualizar -> Mensajes de error por cada campo
   */
  public function update(Request $request, $id)
  {
    if ($request->ajax())
    {
      $usuario = Usuario::findOrFail($id);
      
      //Aseguarse que el campo este asociado a ese dueño
      $rules = [
          'identificacion' => 'required|numeric|unique:usuarios,identificacion,'.$usuario->id,
          'nombres'        => 'required|min:3|max:20',
          'email'          => 'required|email|unique:usuarios,email,' . $usuario->id,
          'slug'           => 'required|max:30|unique:usuarios,slug,' . $usuario->id
      ];
      
      $validation = Validator::make(Input::all(), $rules);
      
      if ($validation->fails())
      {
        return Response::json([
            'fail'     => true,
            'messages' => $validation->messages()
        ]);
      }
      else {
        $usuario->fill($request->all());        
        $usuario->update();
        
        return Response::json([
            'success'  => true,
            'messages' => 'Registro actualizado.'
        ]);
      }
    }
  }
  
  public function destroy($id)
  {
    if (\Request::ajax())
    {
      $usuario = Usuario::findOrFail($id);

      $delete = $usuario->delete();

      if ($delete)
      {
        return Response::json([
            'success'  => true,
            'messages' => 'Registro eliminado.'
        ]);
      } else {
          return Response::json([
              'fail'     => true,
              'messages' => 'Error al eliminar el usuario.'
          ]);
      }
    }
  }
}