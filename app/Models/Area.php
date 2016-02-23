<?php

namespace Siequipos\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class Area extends Model
{
  protected $table = 'areas';
  
  /*
   * Atributos rellenados por asignación masiva
   * $area->fill($data)
   * @var array
   */
  protected $fillable = ['nombre', 'sigla', 'slug'];
  
  public static function boot()
  {
    parent::boot();

    static::saving(function($model)
    {
      $model->slug = Str::slug($model->nombre);

      return true;
    });
  }
  
  // Almacenar los mensajes de error
  public $messages;
  
  public static $rules = [
      'nombre' => 'required|min:5|max:60|unique:areas,nombre,id',
      'sigla'  => 'required|max:4|unique:areas,sigla,id'
  ];
  
  public function isValid($data, $id = null)
  {
    $reglas = self::$rules;
    $reglas['nombre'] = str_replace('id', $id, self::$rules['nombre']);
    $reglas['sigla'] = str_replace('id', $id, self::$rules['sigla']);
    
    // Crear un nuevo objeto $validator que contiene toda la data
    // y las reglas de validación. 
    $validator = Validator::make($data, $reglas);

    // Devuelve TRUE si la validación pasa
    if ($validator->passes())
    {
      return true;
    }

    // Almacenar en la propiedad $messages o $errors los mensajes de
    //error y devolver FALSE si la validación falla
//    $this->errors = $validator->errors();
    $this->messages = $validator->messages();
    return false;
  }
}