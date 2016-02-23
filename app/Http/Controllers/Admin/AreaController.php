<?php

namespace Siequipos\Http\Controllers\Admin;

use Siequipos\Models\Area;
use Illuminate\Http\Request;
use Siequipos\Http\Requests;
use Siequipos\Http\Controllers\Controller;
use View;
use Illuminate\Support\Facades\Input;
use Redirect;

class AreaController extends Controller
{
  /*
   * Instancia del Modelo
   */
  protected $area;
  
  /*
   * Crear una nueva instacia del Controlador
   * 
   * @param Usuario $usuarios
   * @return void
   */
  public function __construct(Area $area)
  {
    $this->area = $area;
    
    $this->message_store  = 'El registro fue creado.';
		$this->message_update = 'El registro fue actualizado.';
		$this->message_delete = 'El registro fue eliminado.';
  }
  
  public function index()
  {
//    $areas = Area::all();
//    $areas = $this->area->all();
//    return view('admin.areas.index', compact('areas'));
    
    $areas = Area::orderBy('nombre', 'asc')->get();
    return View::make('admin.areas.index', ['areas' => $areas]);
  }
  
  //http://www.cristalab.com/tutoriales/modulo-de-usuarios-iii-crear-un-formulario-con-laravel-c111645l/
  public function create()
  {
    $area = new Area;
    
    return View::make('admin.areas.createUpdate')->with('area', $area);
  }
  
  public function store(Request $request)
  {
//    // Validaciones desde el Controlador
//    // $data = Input::all(); // Obtener la data enviada por el usuario
//    $validation = Validator::make(Input::all(), [
//        'nombre' => 'required|min:5|max:60|unique:areas',
//        'sigla'  => 'required|max:4|unique:areas'
//    ]);
//    
//    // Si la validación falla redirigir al formulario con los datos
//    // y los mensaje de error
//    if ($validation->fails())
//    {
//      return Redirect::back()
//              ->withInput()
//              ->withErrors($validation->messages());
//    }
//    $area = new Area;
//    $area->nombre = $request->nombre;
//    $area->sigla  = $request->sigla;
//    $area->slug   = str_slug($area->nombre);
//    $area->save();
//    
//    return Redirect::to('admin/areas')->with([
//        'flash_message' => 'Registro creado.',
//        'flash_message_important' => true
//    ]);
    
    // Validaciones desde el Modelo
    // Crear un nuevo objeto para la nueva área
    // Variable $area para un solo formulario createUpdate
    $area = new Area;
    
    // Revisar si la data es válido
    if ($area->isValid(Input::all()))
    {
      // Guardar la información
      Area::create($request->all());
      
      return Redirect::route('admin.area.listar')->with([
          'flash_message'           => $this->message_store,    //'Registro creado.',
          'flash_message_important' => true
      ]);
    }
    else {
      // Si la validación falla redirigir al formulario con los datos
      // y los errores
      return Redirect::back()             //return Redirect::route('admin.area.crear')
          ->withInput()
          ->withErrors($area->messages);  //->withErrors($area->errors);
    }
  }
  
  public function edit($id)
  {
    // Traer el id numérica almacenada en la variable $id
    $area = Area::find($id);
    
    // Si el área no existe, lanzar un error 404
    if (is_null($area))
    {
      App::abort(404);
    }
    
    // Pasar la data desde el Controlador a la vista
//    $form_data = ['route' => ['admin.area.actualizar', $area->id], 'method' => 'PATCH', 'class' => 'form-horizontal panel'];
//    $action = ' Editar';
//    return View::make('admin.areas.createUpdate', compact('area', 'form_data', 'action'));
    
    return View::make('admin.areas.createUpdate')->with('area', $area);
  }
  
  public function update(Request $request, $id)
  {
    // Crear un nuevo objeto para el nuevo registro
    $area = Area::find($id);
    // Revisar si la data es válido
    if ($area->isValid(Input::all(), $area->id))
    {
      // Si la data es valida se la asignamos a la area
      $area->fill($request->all());
      
      $area->update(Input::all());
      
      return Redirect::route('admin.area.listar')->with([
          'flash_message'           => $this->message_update,    //'Registro actualizado.',
          'flash_message_important' => true
      ]);
    }
    else {
      return Redirect::back()             //return Redirect::route('admin.area.edit')
          ->withInput()
          ->withErrors($area->messages);  //->withErrors($area->errors);      
    }    
  }
  
  public function destroy($id)
	{    
    Area::destroy($id);
    
    return Redirect::route('admin.area.listar')->with([
        'flash_message'           => $this->message_delete,    //'Registro actualizado.',
        'flash_message_important' => true
    ]);
	}
}