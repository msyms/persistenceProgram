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

Route::get('/task', 'TaskController@home');


// 用于处理文件上传
Route::post('form/file_upload', 'RequestController@fileUpload');

Auth::routes();
	
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('upload/uploadImg','UploadController@uploadImg');
//公司信息录入
Route::get('company', 'Home\CompanyController@index')->name('company');
Route::post('company/create', 'Home\CompanyController@create')->name('company/create');
Route::post('company/search', 'Home\CompanyController@search')->name('company/search');

//
Route::get('reset', 'Home\UserController@getReset');
Route::post('reset', 'Home\UserController@postReset');


Route::get('check', 'CheckController@index');
Route::get('check/store', 'CheckController@store');
Route::get('check/update/{id}', 'CheckController@update');

//隐患排查
Route::post('check/create', 'Home\ComcheckController@create');

Route::get('check/show/{id}', 'Home\ComcheckController@show');
Route::get('check/show/{id}/group/{groupId}', 'Home\ComcheckController@show');
Route::get('check/inconform/{id}', 'Home\ComcheckController@inconform');
Route::get('check/choose/{id}', 'Home\ComcheckController@choose');
Route::get('check/del/{id}', 'Home\ComcheckController@del');
Route::get('check/getChecknegative/{id}', 'Home\ComcheckController@getChecknegative');
Route::get('check/getCheckaccord/{id}', 'Home\ComcheckController@getCheckaccord');
Route::get('check/exportWord1/{id}', 'Home\ComcheckController@exportWord1');

Route::get('check/upload', 'UploadController@index');

// 上传excel
Route::post('check/upload/excel', 'UploadController@uploadExcel');
