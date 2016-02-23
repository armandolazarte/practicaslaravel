<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
		Schema::create('areas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 60)->unique();
			$table->string('sigla', 4)->unique();
			$table->string('slug', 40)->unique();
			$table->timestamps();
		});
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('areas');
  }
}