<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Auth::routes(['register' => false]);

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('/about', 'PagesController@about')->name('pages.about');
Route::get('/archive', 'PagesController@archive')->name('pages.archive');
Route::get('/contact', 'PagesController@contact')->name('pages.contact');

Route::get('/blog/{post}', 'PostController@show')->name('posts.show');
Route::get('/category/{category}', 'CategoryController@show')->name('categories.show');
Route::get('/tag/{tag}', 'TagController@show')->name('tags.show');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth'],

    function() {

        Route::get('/', 'AdminController@index')->name('admin');
        // posts routes
        Route::get('posts', 'PostsController@index')->name('admin.posts.index');
        Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
        Route::post('posts', 'PostsController@store')->name('admin.posts.store');
        Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
        Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
        Route::delete('posts/{post}', 'PostsController@destroy')->name('admin.posts.destroy');


        Route::post('posts/{post}/photos', 'PhotoController@store')->name('admin.posts.photos.store');
        Route::delete('photos/{photo}', 'PhotoController@destroy')->name('admin.photo.destroy');
});

