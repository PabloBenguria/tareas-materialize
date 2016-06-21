<?php

Route::get('/', function () {
  if(session()->has('idioma')){
    App::setLocale(session()->get('idioma'));
  }
  return view('welcome');
});

Route::get('idioma/{idioma}', function($id){
    session()->put('idioma', $id);
    return back();
})->where('idioma', '[a-z]{2}');

Route::auth();

Route::get('tareas',[
    'as' => 'tareas.filter.home',
    'uses' => 'HomeController@index'
]);
Route::get('completar/{id}', 'HomeController@getCompletar')->where('id', '[0-9]+');
Route::get('borrar/{id}', 'HomeController@getBorrar')->where('id', '[0-9]+');
Route::get('config', 'HomeController@getConfig');


Route::post('crear', 'HomeController@postCrear');
Route::post('cambiar-pass', 'HomeController@postCambiarPass');
