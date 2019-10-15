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

Route::resource('/posts', 'Api\PostsController')->names([
    'index' => 'api.posts.index',
    'store' => 'api.posts.store',
    'update' => 'api.posts.update',
    'destroy' => 'api.posts.destroy',
]);

Route::view('/views/posts', 'api.posts.index');
Route::view('/views/posts/form/{id?}', 'api.posts.form');
