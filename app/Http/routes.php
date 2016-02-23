<?php

use Siequipos\Models\Task;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'Admin\StudentController@index');
Route::post('save', 'Admin\StudentController@saverecord');
Route::post('showdata', 'Admin\StudentController@display');
Route::post('editrow', 'Admin\StudentController@edit');
Route::post('deleterow', 'Admin\StudentController@delete');
Route::post('update', 'Admin\StudentController@updaterecord');


Route::get('tasks', function () {
    $tasks = Task::all();

    return View::make('admin.tasks')->with('tasks',$tasks);
});

Route::post('/tasks',function(Request $request){
    $task = Task::create($request->all());

    return Response::json($task);
});

Route::get('/tasks/{task_id?}',function($task_id){
    $task = Task::find($task_id);

    return Response::json($task);
});

Route::put('/tasks/{task_id?}',function(Request $request,$task_id){
    $task = Task::find($task_id);

    $task->task = $request->task;
    $task->description = $request->description;

    $task->save();

    return Response::json($task);
});

Route::delete('/tasks/{task_id?}',function($task_id){
    $task = Task::destroy($task_id);

    return Response::json($task);
});

Route::resource('usuarios', 'Admin\UsuarioController', ['except'=>['show']]);
Route::get('usuarios/displayusuarios', 'Admin\UsuarioController@display');

Route::group(['prefix' => 'admin'], function()
{
  Route::group(['prefix' => 'areas'], function()
  {
    Route::get('', ['as' => 'admin.area.listar', 'uses' => 'Admin\AreaController@index']);
    Route::get('crear', ['as' => 'admin.area.crear', 'uses' => 'Admin\AreaController@create']);
    Route::post('', 'Admin\AreaController@store');
    Route::get('editar/{slug}', ['as' => 'admin.area.editar', 'uses' => 'Admin\AreaController@edit']);
    Route::patch('{slug}', ['as' => 'admin.area.actualizar', 'uses' => 'Admin\AreaController@update']);
    Route::delete('{id}', ['as' => 'admin.area.eliminar', 'uses' => 'Admin\AreaController@destroy']);
  });
  Route::group(['prefix' => 'areasajax'], function()
  {
    Route::get('', ['as' => 'area.ajax.listar', 'uses' => 'Admin\AreaAjaxController@index']);
    Route::get('crear', ['as' => 'area.ajax.crear', 'uses' => 'Admin\AreaAjaxController@create']);
    Route::post('', 'Admin\AreaAjaxController@store');
    Route::get('editar/{id}', ['as' => 'area.ajax.editar', 'uses' => 'Admin\AreaAjaxController@edit']);
    Route::patch('{id}', ['as' => 'area.ajax.actualizar', 'uses' => 'Admin\AreaAjaxController@update']);
    Route::delete('{id}', ['as' => 'area.ajax.eliminar', 'uses' => 'Admin\AreaAjaxController@destroy']);
  });
  Route::group(['prefix' => 'areasajaxmodal'], function()
  {
    Route::get('', ['as' => 'area.ajaxmodal.listar', 'uses' => 'Admin\AreaAjaxModalController@index']);
    Route::get('crear', ['as' => 'area.ajaxmodal.crear', 'uses' => 'Admin\AreaAjaxModalController@create']);
    Route::post('', 'Admin\AreaAjaxModalController@store');
    Route::get('editar/{id}', ['as' => 'area.ajaxmodal.editar', 'uses' => 'Admin\AreaAjaxModalController@edit']);
    Route::patch('{id}', ['as' => 'area.ajaxmodal.actualizar', 'uses' => 'Admin\AreaAjaxModalController@update']);
    Route::delete('eliminar/{id}', ['as' => 'area.ajaxmodal.eliminar', 'uses' => 'Admin\AreaAjaxModalController@destroy']);
  });
});