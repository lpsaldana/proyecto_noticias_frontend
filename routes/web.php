<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$router->get('/', function () use ($router) {
    //return $router->app->version();
    return view('login',['nombre'=>'HOLA']);
});*/

$router->get('/', 'LoginController@verLogin');
$router->post('/login', 'LoginController@login');
$router->get('/logout', 'LoginController@cerrar_sesion');
$router->get('/principal', 'NoticiaController@principal');
$router->get('/admin/noticias', 'NoticiaController@noticias');
$router->get('/admin/noticias/nuevo', 'NoticiaController@view_guardar');
$router->post('/admin/noticias/save', 'NoticiaController@guardar');
