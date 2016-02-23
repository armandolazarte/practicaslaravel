<?php

namespace Siequipos\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class BaseModel extends Model
{
  protected $rules = [];
  
  public function isValid($data)
  {
    // Crear un nuevo objeto $validator que contiene toda la data
    // y las reglas de validación. 
    $validator = Validator::make($data, $this->rules);

    // Devuelve TRUE si la validación pasa
    if ($validator->passes())
    {
      return true;
    }

    // Almacenar en la propiedad $messages o errors los mensajes de error y
    // devolver FALSE si la validación falla
//    $this->errors = $validator->errors();
    $this->messages = $validator->messages();
    return false;
  }
}
  
  
  
//  public function rules()
//  {
//    return $rules = [];
//  }
//  public function isValid($id = '')
//  {
////    $rules = array();
////    foreach($rules as $keys => $value)
////    {
////      $validations = explode('|', $value);
////      
////      foreach($validations as $key=>$value)
////      {
////        $validations[$key] = str_replace('{{$id}}', $id, $value);
////      }
////      $implode = implode("|", $validations);
////      $rules[$keys] = $implode;
////    }    
//    
//    // Crear un nuevo objeto $validator que contiene toda la data
//    // y las reglas de validación.
//    //return \Illuminate\Validation\Factory::make($data, $rules, $messages, $customAttributes);
////    $validator = Validator::make(Input::all(), static::$rules);
//    $validator = Validator::make($this->attributes, $this->rules($id));
////    $validator = Validator::make($data, static::$rules);
////    $validator = Validator::make($data, $this->rules($id));
////    $validator = Validator::make(Input::all(), $this->rules($id));
////    $validator = Validator::make($data, $this->rules());
//
//    // Devuelve TRUE si la validación pasa
//    if ($validator->passes())
//    {
//      return true;
//    }
//
//    // Almacenar en la propiedad $messages o errors los mensajes de error y
//    // devolver FALSE si la validación falla
////    $this->errors = $validator->errors();
//    $this->messages = $validator->messages();
//    return false;
//  }
  
  
  
//  public function isValid($data)
//  {
//    if (static::$rules)
//    {
//      // Crear un nuevo objeto $validator que contiene toda la data
//      // y las reglas de validación. 
//      $validator = Validator::make($data, static::$rules);
//
//      // Devuelve TRUE si la validación pasa
//      if ($validator->passes())
//      {
//        return true;
//      }
//
//      // Almacenar en la propiedad $messages o errors los mensajes de error y
//      // devolver FALSE si la validación falla
//  //    $this->errors = $validator->errors();
//      $this->messages = $validator->messages();
//      return false;
//    }
//    
//    // Si el área existe - propiedad $this->exists
//    if ($this->exists)
//    {
//      // Evitar que la regla “unique” tome en cuenta los campos de la área actual
//      $rules[$data] .= ',$data,' . $this->id;
//    }
//    // Si no existe
//    else {
//      // Los campos obligatorios
////      $rules['password'] .= '|required';
//    }
//  }