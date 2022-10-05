<?php


use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


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

//商品一覧
Route::get('/products', 'ProductController@index')->name('products.index');

//商品検索
Route::get('/search', 'ProductController@search')->name('products.search');

//商品登録フォーム
Route::get('/products/create', 'ProductController@create')->name('products.create');

// 商品追加
Route::post('/products', 'ProductController@store')->name('products.store');

// 商品詳細
Route::get('/products/{id}', 'ProductController@show')->name('products.show');

// 商品編集フォーム
Route::get('/products/{id}/edit', 'ProductController@edit')->name('products.edit');

// 商品更新
Route::patch('/products/{id}', 'ProductController@update')->name('products.update');

// 商品削除
Route::post('/delete', 'ProductController@destroy')->name('products.delete');


