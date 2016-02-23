<?php

namespace Siequipos\Http\Controllers\Admin;

use Siequipos\Models\Area;
use Illuminate\Http\Request;
use Siequipos\Http\Requests;
use Siequipos\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use View;
use Response;
use Redirect;

class AreaAjaxController extends Controller
{
  /*
   * Instancia del Modelo
   */
  protected $area;
  
  /*
   * Crear una nueva instacia del Controlador
   * 
   * @param Area $areas
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
    $areas = Area::all();
//    return View::make('admin.areasAjax.index', ['areas' => $areas]);
    return View::make('admin.areasAjax.index', compact('areas'));
  }
  
  public function create()
  {
    $area = new Area;
    return View::make('admin.areasAjax.createUpdate')->with('area', $area);
  }
  
  public function store(Request $request)
  {
    // Validaciones desde el Modelo 
    if ($request->ajax())
    {
      if (! $this->area->isValid(Input::all()))
      {
        //Si la validación falla, redirigir al formulario con los errores
        //Como ha fallado el formulario, devolvemos los datos en formato json
        return Response::json([
            'fail'     => true,
            'messages' => $this->area->messages
        ]);
      }
      else {
        Area::create($request->all());
        
        return Response::json([
            'success'  => true,
            'messages' => $this->message_store,
            'url'      => '/admin/areasajax'
        ]);
      }
    }
  }
  
  public function edit($id)
  {    
    // Traer el id numérica almacenada en la variable $id
    $area = Area::findOrfail($id);
    
    // Pasar la data desde el Controlador a la vista
//    $form_data = ['route' => ['admin.area.actualizar', $area->id], 'method' => 'PATCH', 'class' => 'form-horizontal panel'];
//    $action = ' Editar';
    return View::make('admin.areasAjax.createUpdate', compact('area', 'form_data', 'action'));
    
//    return View::make('admin.areasAjax.edit')->with('area', $area);
  }
  
  public function update(Request $request, $id)
  {
    if ($request->ajax())
    {
      $area = Area::findOrFail($id);
      
      if (! $this->area->isValid(Input::all(), $area->id))
      {
        return Response::json([
            'fail'     => true,
            'messages' => $this->area->messages
        ]);
      }
      else {
        $area->fill($request->all());        
        $area->update();
        
        return Response::json([
            'success'  => true,
            'messages' => $this->message_update,    //'Registro actualizado.'
            'url'      => '/admin/areasajax'
        ]);
      }
    }
  }
  
  public function destroy(Request $request, $id)
  {
    if ($request->ajax())
    {
      Area::destroy($id);
      
      return Response::json([
          'message' => $this->message_delete,
          'url'     => '/admin/areasajax'
      ]);
    }    
  }
}