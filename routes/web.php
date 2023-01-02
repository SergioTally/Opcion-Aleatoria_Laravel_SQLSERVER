<?php
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Support\Facades\Route;

Route::get('seguridad/login', 'Seguridad\LoginController@index')->name('login');
Route::post('seguridad/login', 'Seguridad\LoginController@login')->name('login_post');
Route::get('seguridad/logout', 'Seguridad\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home')->middleware(['auth']);

Route::get('suerte/dado', 'Suerte\DadoController@index')->name('dado');
Route::get('suerte/dado/crear', 'Suerte\DadoController@create')->name('dado.crear');
Route::post('suerte/dado/cuentacontable', 'Suerte\DadoController@store')->name('dado.guardar');
Route::get('suerte/caras/{id}', 'Suerte\DadoController@show')->name('caras');

Route::get('menu/agregar', 'Suerte\DadoController@agregarmenu')->name('agregar.menu');
