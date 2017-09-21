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

Route::middleware('guest')->get('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('can:website.admin.permission')->prefix('permission')->namespace('Permission')->group(function () {
    Route::get('/', 'IndexController@index');
    Route::prefix('permission')->group(function () {
        Route::get('/', 'PermissionController@index');
        Route::get('create', 'PermissionController@create');
        Route::post('/', 'PermissionController@store');
        Route::get('{id}', 'PermissionController@show');
        Route::put('{id}', 'PermissionController@update');
        Route::get('{id}/edit', 'PermissionController@edit');
        Route::delete('{id}', 'PermissionController@destroy');
    });
    Route::prefix('role')->group(function () {
        Route::get('/', 'RoleController@index');
        Route::get('create', 'RoleController@create');
        Route::post('/', 'RoleController@store');
        Route::get('{id}', 'RoleController@show');
        Route::put('{id}', 'RoleController@update');
        Route::get('{id}/edit', 'RoleController@edit');
        Route::delete('{id}', 'RoleController@destroy');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('create', 'UserController@create');
        Route::post('/', 'UserController@store');
        Route::get('{id}', 'UserController@show');
        Route::put('{id}', 'UserController@update');
        Route::get('{id}/edit', 'UserController@edit');
        Route::delete('{id}', 'UserController@destroy');
    });
    Route::prefix('token')->group(function () {
        Route::get('/', 'TokenController@index');
        Route::get('create', 'TokenController@create');
        Route::post('/', 'TokenController@store');
        Route::get('{id}', 'TokenController@show');
        Route::put('{id}', 'TokenController@update');
        Route::get('{id}/edit', 'TokenController@edit');
        Route::delete('{id}', 'TokenController@destroy');
    });
});