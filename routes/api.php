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

Route::post('/register', 'Auth\AuthController@register')->name('register');
Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::get('/user', 'Auth\AuthController@user');
Route::post('/logout', 'Auth\AuthController@logout');

Route::group(['prefix' => 'topics'], function () {
	Route::post('/', 'TopicController@store')->middleware('auth:api');
	Route::get('/', 'TopicController@index');
	Route::get('/{topic}', 'TopicController@show');
	Route::patch('/{topic}', 'TopicController@update')->middleware('auth:api');
	Route::delete('/{topic}', 'TopicController@destroy')->middleware('auth:api');
	// // post route groups
	// Route::group(['prefix' => '/{topic}/posts'], function () {
	// 	Route::get('/{post}', 'PostController@show');
	// 	Route::post('/', 'PostController@store')->middleware('auth:api');
	// 	Route::patch('/{post}', 'PostController@update')->middleware('auth:api');
	// 	Route::delete('/{post}', 'PostController@destroy')->middleware('auth:api');
	// 	// likes
	// 	Route::group(['prefix' => '/{post}/likes'], function () {
	// 		Route::post('/', 'PostLikeController@store')->middleware('auth:api');
	// 	});
	// });
});