<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'PlanDePruebasController@index')->name('index');
Route::get('/user/plan_pruebas/crear', 'PlanDePruebasController@create')->name('crear_plan_prueba');
Route::get('/user/plan_pruebas/editar/{id}', 'PlanDePruebasController@edit')->name('editar_plan_prueba');
Route::post('/user/plan_pruebas/guardar', 'PlanDePruebasController@store')->name('guardar_plan_prueba');
Route::post('/user/plan_pruebas/actualizar/{id}', 'PlanDePruebasController@update')->name('actualizar_plan_prueba');
Route::get('/user/plan_pruebas/{id}/ver', ['as' => 'ver_plan_prueba', 'uses' => 'PlanDePruebasController@show']);
Route::get('/user/plan_pruebas/ordenar_casos_prueba/{id}', 'PlanDePruebasController@ordenarCasosPrueba')->name('ordenar_casos_prueba');
Route::get('/user/plan_pruebas/eliminar/{id}', 'PlanDePruebasController@destroy')->name('borrar_plan_prueba');

Route::get('/user/caso_prueba/crear/{id}', 'CasoDePruebaController@create')->name('crear_caso_prueba');
Route::get('/user/caso_prueba/editar/{id}/{id_plan}', 'CasoDePruebaController@edit')->name('editar_caso_prueba');
Route::post('/user/caso_prueba/guardar/{id_plan}', 'CasoDePruebaController@store')->name('guardar_caso_prueba');
Route::post('/user/caso_prueba/actualizar/{id}/{id_plan}', 'CasoDePruebaController@update')->name('actualizar_caso_prueba');
Route::get('/user/caso_prueba/ver/{id}', 'CasoDePruebaController@show')->name('ver_caso_prueba');
Route::get('/user/caso_prueba/eliminar/{id}','CasoDePruebaController@destroy')->name('borrar_caso_prueba');

/** Rutas Axios **/
Route::get('/ejecucion_prueba/actividades_respuestas/get/{id}', 'ActividadRespuestaController@obtenerActRespNivel')->name('obtener_act_resp_nivel');
Route::get('/actividades_respuestas/get/{id}', 'ActividadRespuestaController@index')->name('obtener_actividades_respuestas');
Route::get('/casos_de_prueba/get/{id}', 'PlanDePruebasController@obtenerCasosDePrueba')->name('obtener_casos_de_prueba');
Route::post('/casos_de_prueba/post/{id}', 'PlanDePruebasController@guardarOrdenCasosDePrueba')->name('guardar_orden_casos_de_prueba');


Route::get('/ejecucion_plan_pruebas/ejecucion_nivel/{id}', 'EjecucionPlanPruebaController@retornarVistaNivelAEjecutar')->name('ejecucion_nivel');
Route::get('/ejecucion_plan_pruebas/niveles/{id}', 'EjecucionPlanPruebaController@retornarVistaNiveles')->name('niveles_ejecucion');
Route::get('/ejecucion_plan_pruebas/definicion_de_errores/{id}', 'EjecucionPlanPruebaController@retornarVistaErrores')->name('definicion_errores');
Route::get('/ejecucion_plan_pruebas/bienvenido/{id}', 'EjecucionPlanPruebaController@comenzarEjecucion')->name('comenzar_ejecucion');
Route::get('/ejecucion_plan_pruebas/{id}/{codigo_verificador}' , 'EjecucionPlanPruebaController@index')->name('ejecucion_plan_prueba');
Route::post('/ejecucion_plan_pruebas/registrar/{id_plan}' , 'EjecucionPlanPruebaController@registrar_ejecutor')->name('registro_ejecutor');
Route::post('/ejecucion_plan_pruebas/registrar/ejecucion_nivel' , 'EjecucionPlanPruebaController@registrar_ejecucion_nivel')->name('guardar_ejecucion_nivel');