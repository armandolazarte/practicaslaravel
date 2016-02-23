<?php

use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
  public function run()
  {    
    /**
     * Evitar eliminar las tablas y duplicar los datos
     */
//    DB::table('areas')->delete();
    
    factory(Siequipos\Models\Area::class, 10)->create();
  }
}