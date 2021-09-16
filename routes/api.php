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
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');
Route::get('comments', 'App\Http\Controllers\ComentarioController@index');
Route::post('infotecnicos','App\Http\Controllers\TecnicoController@store');


Route::group(['middleware' => ['jwt.verify']], function() {

    //rutas para filtrar las solicitudes por usuario
    Route::get('/users/solicitudes/{user}','App\Http\Controllers\UserController@showUserSolicitud');

    //rutas usuario
    Route::get('user', 'App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::get('users/{user}', 'App\Http\Controllers\UserController@');
    Route::put('users/{user}', 'App\Http\Controllers\UserController@');
    Route::delete('users/{user}', 'App\Http\Controllers\UserController@');
    Route::post('logout', 'App\Http\Controllers\UserController@logout');
    //Rutas comentarios
    Route::get('comments/{comment}', 'App\Http\Controllers\ComentarioController@show');
    Route::post('comments', 'App\Http\Controllers\ComentarioController@store');
    Route::put('comments/{coment}', 'App\Http\Controllers\ComentarioController@update');
    Route::delete('comments/{coment}', 'App\Http\Controllers\ComentarioController@delete');
    //Rutas Postulaciones
    Route::get('postulaciones', 'App\Http\Controllers\PostulacionController@index');
    Route::get('postulaciones/{postulacion}', 'App\Http\Controllers\PostulacionController@show');
    Route::post('postulaciones', 'App\Http\Controllers\PostulacionController@store');
    Route::put('postulaciones/{postulacion}', 'App\Http\Controllers\PostulacionController@update');
    Route::delete('postulaciones/{postulacion}', 'App\Http\Controllers\PostulacionController@delete');
    
    //Rutas Solicitudes
    Route::get('solicitudes', 'App\Http\Controllers\SolicitudController@index');
    Route::get('solicitudes/{solicitud}', 'App\Http\Controllers\SolicitudController@show');
    Route::post('solicitudes', 'App\Http\Controllers\SolicitudController@store');
    Route::put('solicitudes/{solicitud}', 'App\Http\Controllers\SolicitudController@update');
    Route::delete('solicitudes/{solicitud}', 'App\Http\Controllers\SolicitudController@delete');
    //Rutas Calificacion
  //  Route::get('calificaciones', 'App\Http\Controllers\SolicitudController@index');
    Route::get('calificaciones/{calificacion}', 'App\Http\Controllers\SolicitudController@show');
    Route::post('calificaciones', 'App\Http\Controllers\SolicitudController@store');
    Route::put('calificaciones/{calificacion}', 'App\Http\Controllers\SolicitudController@update');
    Route::delete('calificaciones/{calificacion}', 'App\Http\Controllers\SolicitudController@delete');

    //rutas datos del tecnico 
    
    Route::get('infotecnicos','App\Http\Controllers\TecnicoController@index');

});