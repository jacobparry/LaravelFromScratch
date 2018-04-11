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


// List all posts
Route::get('posts', 'PostsAPIController@index');

// List single post
Route::get('post/{id}' ,'PostsAPIController@show');

// Create new post
Route::post('post' ,'PostsAPIController@store');

// Update post
Route::put('post' ,'PostsAPIController@store');

// Delete Post
Route::delete('post/{id}', 'PostsAPIController@destroy');