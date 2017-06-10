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

Auth::routes();

Route::get('/register/verify', 'Auth\RegisterController@getVerify');
Route::get('/register/verify/{token}', 'Auth\RegisterController@verify');
Route::get('/category/{id}/posts', 'PostController@postsByCategory');
Route::resource('/home', 'HomeController');
Route::resource('category', 'CategoryController');
Route::resource('post', 'PostController');



