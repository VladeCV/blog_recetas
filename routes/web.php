<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\RecetaController;
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
Route::get('/recetas','App\Http\Controllers\RecetaController@index')->name('recetas.index');
Route::get('/recetas/create','App\Http\Controllers\RecetaController@create')->name('recetas.create');
Route::post('/recetas','App\Http\Controllers\RecetaController@store')->name('recetas.store');
Route::get('recetas/{receta}','App\Http\Controllers\RecetaController@show')->name('recetas.show');
Route::get('recetas/{receta}/edit','App\Http\Controllers\RecetaController@edit')->name('recetas.edit');
Route::put('recetas/{receta}','App\Http\Controllers\RecetaController@update')->name('recetas.update');
Route::delete('recetas/{receta}','App\Http\Controllers\RecetaController@destroy')->name('recetas.destroy');

Route::get('perfiles/{perfil}','App\Http\Controllers\PerfilController@show')->name('perfiles.show');
Route::get('perfiles/{perfil}/edit','App\Http\Controllers\PerfilController@edit')->name('perfiles.edit');
Route::put('perfiles/{perfil}','App\Http\Controllers\PerfilController@update')->name('perfiles.update');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
