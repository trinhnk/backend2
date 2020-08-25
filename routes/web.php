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

// Route::get('/', function () {
//     return view('welcome');
// });
use App\Item;
use App\Article;

Route::get('/', function () {
    // Article::createIndex($shards = null, $replicas = null);
// 
    // Article::putMapping($ignoreConflicts = true);

    Article::addAllToIndex();

    return view('welcome');
});

// Route::get('/search', function() {

//     // $item = Item::searchByQuery(['match' => ['title' => 'Car']]);
//     $item = Item::searchByQuery(['match' => ['title' => 'tit']]);

//     return $item;
// });

Route::get('/search2', function() {
    $item = Item::where('title', 'Cartitle')->get();

    return $item;
});

Route::get('/reindex', function() {
    Item::reindex();
    echo 1;
});

Route::get('ItemSearch', 'ItemSearchController@index');

Route::get('search', 'ItemSearchController@articleSearch');