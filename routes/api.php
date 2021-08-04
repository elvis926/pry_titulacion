<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Rutas publicas

Route::get('users', 'App\Http\Controllers\ComentarioController@index');

//Rutas comentarios
Route::get('comments', 'App\Http\Controllers\ComentarioController@index');
Route::post('comments', 'App\Http\Controllers\ComentarioController@store');
Route::put('comments', 'App\Http\Controllers\ComentarioController@update');
Route::delete('comments', 'App\Http\Controllers\ComentarioController@delete');
//Rutas Postulaciones
Route::get('postulaciones', 'App\Http\Controllers\PostulacionController@index');
Route::post('postulaciones', 'App\Http\Controllers\PostulacionController@store');
Route::put('postulaciones', 'App\Http\Controllers\PostulacionController@update');
Route::delete('postulaciones', 'App\Http\Controllers\PostulacionController@delete');
//Rutas tecnicos
Route::get('tecnicos', 'App\Http\Controllers\TecnicoController@index');
Route::post('tecnicos', 'App\Http\Controllers\TecnicoController@store');
Route::update('tecnicos', 'App\Http\Controllers\TecnicoController@update');
Route::post('tecnicos', 'App\Http\Controllers\TecnicoController@delete');
//Rutas calificaciones
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
