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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'SiteController@listSite')->name('welcome');
Route::post('/sign/{id}', 'SiteController@sign')->middleware('auth')->name('sign');
Route::get('/sign/{id}', 'SiteController@signNoLogin')->middleware('auth')->name('sign');
Route::get('/rounds/{id}', 'SiteController@rounds')->middleware('auth')->name('rounds');
Route::get('/rounds/matches/{id}', 'SiteController@matches')->middleware('auth')->name('matches');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Rotas de usuários
Route::get('/users', 'UserController@index')->middleware(['can:access-user','auth'])->name('admin.users.index');
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

// Rotas Bettings (apostas)
Route::get('/betting', 'BettingController@index')->middleware('auth')->name('admin.bettings.index');
Route::get('/betting/show/{id}', 'BettingController@show')->middleware('auth')->name('admin.bettings.show');
Route::get('/betting/create', 'BettingController@create')->middleware('auth')->name('admin.bettings.create');
Route::post('/betting', 'BettingController@store')->middleware('auth')->name('admin.bettings.store');
Route::get('/betting/edit/{id}', 'BettingController@edit')->middleware('auth')->name('admin.bettings.edit');
Route::put('/betting/{id}', 'BettingController@update')->middleware('auth')->name('admin.bettings.update');
Route::delete('/betting/{id}', 'BettingController@destroy')->middleware('auth')->name('admin.bettings.destroy');

// Rotas Round (rodadas)
Route::get('/round', 'RoundController@index')->middleware('auth')->name('admin.rounds.index');
Route::get('/round/create', 'RoundController@create')->middleware('auth')->name('admin.rounds.create');
Route::post('/round', 'RoundController@store')->middleware('auth')->name('admin.rounds.store');
Route::get('/round/edit/{id}', 'RoundController@edit')->middleware('auth')->name('admin.rounds.edit');
Route::put('/round/{id}', 'RoundController@update')->middleware('auth')->name('admin.rounds.update');
Route::delete('/round/{id}', 'RoundController@destroy')->middleware('auth')->name('admin.rounds.destroy');

// Rotas Matches (partidas)
Route::get('/matches', 'MatchController@index')->middleware('auth')->name('admin.matches.index');
Route::get('/matches/create', 'MatchController@create')->middleware('auth')->name('admin.matches.create');
Route::post('/matches', 'MatchController@store')->middleware('auth')->name('admin.matches.store');
Route::get('/matches/edit/{id}', 'MatchController@edit')->middleware('auth')->name('admin.matches.edit');
Route::get('/matches/show/{id}', 'MatchController@show')->middleware('auth')->name('admin.matches.show');
Route::put('/matches/{id}', 'MatchController@update')->middleware('auth')->name('admin.matches.update');
Route::delete('/matches/{id}', 'MatchController@destroy')->middleware('auth')->name('admin.matches.destroy');
