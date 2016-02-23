<?php

namespace Siequipos\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = ['task', 'description','done'];
}