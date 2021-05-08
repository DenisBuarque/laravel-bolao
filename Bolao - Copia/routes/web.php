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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Rotas de usuários
Route::get('/users', 'UserController@index')->middleware('can:access-user,auth')->name('admin.users.index');
Route::get('/users/create', 'UserController@create')->middleware('auth')->name('admin.users.create');
Route::post('/users', 'UserController@store')->middleware('auth')->name('admin.users.store');
Route::get('/users/edit/{id}', 'UserController@edit')->middleware('auth')->name('admin.users.edit');
Route::put('/users/{id}', 'UserController@update')->middleware('auth')->name('admin.users.update');
Route::get('/users/show/{id}', 'UserController@show')->middleware('auth')->name('admin.users.show');
Route::delete('/users/{id}', 'UserController@destroy')->middleware('auth')->name('admin.users.destroy');

// Rotas Permissões
Route::get('/permissions', 'PermissionController@index')->middleware('auth')->name('admin.permissions.index');
Route::get('/permissions/create', 'PermissionController@create')->middleware('auth')->name('admin.permissions.create');
Route::post('/permissions', 'PermissionController@store')->middleware('auth')->name('admin.permissions.store');
Route::get('/permissions/edit/{id}', 'PermissionController@edit')->middleware('auth')->name('admin.permissions.edit');
Route::put('/permissions/{id}', 'PermissionController@update')->middleware('auth')->name('admin.permissions.update');
Route::delete('/permissions/{id}', 'PermissionController@destroy')->middleware('auth')->name('admin.permissions.destroy');

// Rotas Roles (cargos ou funções)
Route::get('/roles', 'RoleController@index')->middleware('auth')->name('admin.roles.index');
Route::get('/roles/create', 'RoleController@create')->middleware('auth')->name('admin.roles.create');
Route::post('/roles', 'RoleController@store')->middleware('auth')->name('admin.roles.store');
Route::get('/roles/edit/{id}', 'RoleController@edit')->middleware('auth')->name('admin.roles.edit');
Route::put('/roles/{id}', 'RoleController@update')->middleware('auth')->name('admin.roles.update');
Route::delete('/roles/{id}', 'RoleController@destroy')->middleware('auth')->name('admin.roles.destroy');
