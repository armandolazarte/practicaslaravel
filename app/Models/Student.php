<?php

namespace Siequipos\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_name', 'gender', 'phone'];
}
