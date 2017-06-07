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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register/verify', 'Auth\RegisterController@getVerify');
Route::get('/register/verify/{token}', 'Auth\RegisterController@verify');
Route::resource('category', 'CategoryController');
// Route::delete('delete/{id}',array('uses' => 'CategoryController@destroy', 'as' => 'My.route'));
// Route::put('category/{id}',array('uses' => 'CategoryController@update', 'as' => 'My.route'));
