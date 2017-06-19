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
    return redirect()->intended('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('role', 'RoleController');
Route::resource('permission', 'PermissionController');

Route::get('/workflow/downloadfile', 'WorkflowController@downloadfile');
Route::get('/workflow/estadistica', 'WorkflowController@estadistica');
Route::get('/workflow/proceso', 'WorkflowController@proceso');
Route::resource('workflow', 'WorkflowController');
