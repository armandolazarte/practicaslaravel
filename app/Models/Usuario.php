<?php

namespace Siequipos\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{  
  protected $table = 'usuarios';
  
  protected $fillable = ['identificacion', 'nombres', 'email', 'slug'];
}