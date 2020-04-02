<?php

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

Route::get('/inicio/{nombre?}', function($nombre = null){    
    $texto = '<h2>Bienvenido </h2>';
    $texto .= " Eres un patatero ".$nombre;
    return view('pruebas', array(
        
        'MiTexto' => $texto
        
    ));
    
    
});
Route::get("/pruebas/animales","PruebasController@index");
Route::get("/pruebas/test","PruebasController@testORM");

Route::get("/usuario/pruebas","UserController@pruebas");
Route::get("/category/pruebas","CategoryController@pruebas");
Route::get("/post/pruebas","PostController@pruebas");


Route::post("/api/register","UserController@register");
Route::post("/api/login","UserController@login");
Route::post("/api/user/update","UserController@update");