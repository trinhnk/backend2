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
Route::get('/user', 'Auth\AuthController@user')->middleware('auth:api');
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

Route::group(['prefix' => 'categories'], function () {
	Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
		Route::post('/create', 'CategoryController@store');
		Route::patch('/{category}', 'CategoryController@update');
		Route::delete('/{category}', 'CategoryController@destroy');
	});
	Route::get('/', 'CategoryController@index');
	Route::get('/{category}', 'CategoryController@show');
	Route::get('/{category}/details', 'CategoryController@categoryDetails');
});

Route::group(['prefix' => 'articles'], function () {
	Route::group(['middleware' => ['auth:api', 'role:admin|writer']], function () {
		Route::post('/create', 'ArticleController@store');
		Route::patch('/{article}', 'ArticleController@update');
		Route::delete('/{article}', 'ArticleController@destroy');
	});
	Route::get('/', 'ArticleController@index');
	Route::get('/{article}', 'ArticleController@show');
	Route::get('/user/{user_id}', 'ArticleController@showByUser');
});

Route::group(['prefix' => 'comments'], function () {
	Route::post('/create', 'CommentController@store')->middleware('auth:api');
	Route::get('/{article}', 'CommentController@showByArticle');
	// Route::detete('/{comment}','CommentController@destroy')->middleware('auth:api');
	Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
		Route::delete('/{comment}', 'CommentController@destroy');
	});
});

Route::group(['prefix' => 'listusers'], function () {
	Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
		Route::get('/', 'UserController@all');
		Route::get('/{user}', 'UserController@user');
		Route::patch('/{user}', 'UserController@update');
		Route::delete('/{user}', 'UserController@destroy');
		Route::post('/create', 'UserController@register');
	});
});

Route::get('search', 'ItemSearchController@articleSearch');

Route::get('ItemSearch', 'ItemSearchController@index');
Route::post('ItemSearchCreate', 'ItemSearchController@create');

