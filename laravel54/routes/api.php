<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'Api\LoginController@login');


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('company/search', 'Api\CompanyController@search');
	Route::post('company/create', 'Api\CompanyController@create');

	Route::post('check/create', 'Api\ComcheckController@create');
	Route::post('check/getChecknegative', 'Api\ComcheckController@getChecknegative');
	Route::post('check/getCheckaccord', 'Api\ComcheckController@getCheckaccord');
	Route::post('check/choose', 'Api\ComcheckController@choose');
	Route::post('check/show', 'Api\ComcheckController@show');
	Route::post('check/inconform', 'Api\ComcheckController@inconform');
	Route::post('upload/uploadimg','Api\UploadController@uploadImg');
	Route::post('check/inconformdel', 'Api\ComcheckController@inconformdel');
	Route::post('check/exportWord1', 'Api\ComcheckController@exportWord1');
});