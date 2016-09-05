<?php

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


Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/file/{file}', 'FileController@index');
Route::get('/file', 'FileController@create');
Route::get('/file/{file}/edit', 'FileController@edit');
Route::patch('/file/{file}/update', 'FileController@update');
Route::post('/file/store', 'FileController@store');
Route::delete('/file/{file}/delete', 'FileController@delete');

Route::get('/file/{file}/task', 'TaskController@create');
Route::get('/task/{task}/edit', 'TaskController@edit');
Route::patch('/task/{task}/update', 'TaskController@update');
Route::post('/file/{file}/task/store', 'TaskController@store');
Route::delete('/task/{task}/delete', 'TaskController@delete');


