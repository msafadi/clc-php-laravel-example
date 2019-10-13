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

Route::get('/posts', 'PostsController@index')->name('posts');
Route::get('/posts/{slug}', 'PostsController@view')->name('post');


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
    ->middleware(['auth:web,admin'])
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
    
        Route::get('/{id}/tags', 'PostsController@tags')->name('posts.tags');
    });

    Route::get('tags/{id}/posts', 'TagsController@posts')->name('tags.posts');
    

    Route::get('/categories/{id}/posts', 'CategoriesController@posts')->name('categories.posts');
    Route::resource('/categories', 'CategoriesController')->names([
        //'index' => 'categories',
        //'store' => 'save',
    ]);
});

Route::get('/posts/{id}/comments', 'CommentsController@index');
Route::post('/posts/{id}/comments', 'CommentsController@store')->name('comments.store');

Route::get('/uploads/{image}', 'ImagesController@index')->name('uploads');

Route::get('users/{id}/address', function($id) {
    $user = App\User::find($id);

    return $user->address;
});

Route::get('addresses/{id}/user', function($id) {
    $address = App\Address::where('user_id', $id)->first();

    return $address->user;
});




Auth::routes([
    'register' => true,
    'verify' => true,
]);

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.loginForm');
Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
Route::get('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

Route::get('/admin/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.resetLink');
Route::post('/admin/password/reset', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sendLink');

Route::get('/admin/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.resetForm');
Route::post('/admin/password/update', 'Admin\Auth\ResetPasswordController@reset')->name('admin.reset');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2', 'HomeController@home')->name('home2');
Route::get('/home3', 'HomeController@home3')->name('home3');
