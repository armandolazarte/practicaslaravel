<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Siequipos\Models\Area;

class AreaTest extends TestCase
{
  public function testUpdateExistingUser()
  {
    $area = Area::find(1);
    $result = $area->id;
    $this->assertEquals(true, $result);
    $area->nombre = 'test update';
    $area->sigla = 'test';
    $area->slug = 'test-update';
    $area->save();

    $this->assertTrue($area->isValid($area->id), 'Expected to pass');
  }
}