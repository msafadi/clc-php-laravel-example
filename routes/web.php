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

Route::get('/home/front', function () {
    return view('home');
});
//Route::view('/', 'welcome');

Route::get('/welcome/to/laravel', function() {
    return 'Welcome to Laravel!';
});

Route::get('/say-hello/{name}/{age}', function($name, $age) {
    return 'Hello! ' . $name . " ($age)";
});

Route::get('/hello/{name?}', function($name = 'World') {
    return 'Hello! ' . $name;
});

//Route::get(); // GET
//Route::post(); // POST Method
//Route::put(); // PUT Method
//Route::patch(); // PATCH
//Route::delete(); // DELETE

Route::get('/posts', 'PostsController@index');
Route::get('/posts/{id}', 'PostsController@view');


/*Route::group([
    'prefix' => '/admin/posts',
    'namespace' => 'Admin',
], function() {
    Route::get('/', 'PostsController@index');
    Route::get('/create', 'PostsController@create');
    Route::post('/', 'PostsController@store');
    Route::get('/{id}/edit', 'PostsController@edit');
    Route::put('/{id}', 'PostsController@update');
    Route::delete('/{id}/delete', 'PostsController@destory');
});*/

Route::prefix('/admin')
    ->namespace('Admin')
    ->group(function() {

    Route::prefix('/posts')
        ->group(function() {
        Route::get('/', 'PostsController@index')->name('posts.index');
        Route::get('/create', 'PostsController@create')->name('posts.create');
        Route::post('/', 'PostsController@store')->name('posts.store');
        Route::get('/{id}/edit', 'PostsController@edit')->name('posts.edit');
        Route::put('/{id}', 'PostsController@update')->name('posts.update');
        Route::delete('/{id}/delete', 'PostsController@destroy')->name('posts.destroy');

        Route::get('/trash', 'PostsController@trash')->name('posts.trash');
        Route::put('/trash/{id}/restore', 'PostsController@restore')->name('posts.restore');
        Route::delete('/trash/{id}', 'PostsController@forceDelete')->name('posts.forceDelete');
    });
    

    Route::resource('/categories', 'CategoriesController')->names([
        //'index' => 'categories',
        //'store' => 'save',
    ]);
});



