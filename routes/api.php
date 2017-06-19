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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//auth
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::post('register', 'AuthController@register');

//category
Route::post('addCategory', 'CategoryController@add');
Route::get('myCategory', 'CategoryController@my');
Route::get('allCategory', 'CategoryController@all');
Route::get('editCategory/{id}', 'CategoryController@edit');
Route::put('updateCategory/{id}', 'CategoryController@update');
Route::delete('deleteCategory/{id}', 'CategoryController@delete');

//post
Route::post('addPost', 'PostController@add');
Route::get('myPost', 'PostController@my');
Route::get('allPost', 'PostController@all');
Route::put('editPost', 'PostController@edit');
Route::delete('deletePost', 'PostController@delete');






