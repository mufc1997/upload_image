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


Auth::routes();

Route::get('/{project?}', 'HomeController@index')->name('home');
Route::post('/upload', 'FileController@fileUpload')->name('upload');
Route::post('/addproject', 'FileController@addProject')->name('project');
Route::get('/file/{file_id}', 'FileController@delete')->name('file_delete');
Route::get('/project/{file_id}', 'FileController@deleteProject')->name('project_delete');
Route::post('/edit/{file_id}', 'FileController@edit')->name('edit');
Route::post('/editProject/{project_id}', 'FileController@editProject')->name('editProject');

