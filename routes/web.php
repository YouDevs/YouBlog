<?php

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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts/{category}', 'HomeController@postsByCategory')->name('posts.category');
Route::get('/post/{post}', 'HomeController@post')->name('post');

Route::get('/home', function(){
    return view('home');
})->middleware('auth');

Route::get('/admin/categories', 'Admin\CategoriesController@index')->name('admin.categories.index');
Route::post('/admin/categories/store', 'Admin\CategoriesController@store')->name('admin.categories.store');
Route::post('/admin/categories/{categoryId}/update', 'Admin\CategoriesController@update')->name('admin.categories.update');
Route::delete('/admin/categories/{categoryId}/delete', 'Admin\CategoriesController@delete')->name('admin.categories.delete');

Route::get('/admin/posts', 'Admin\PostsController@index')->name('admin.posts.index');
Route::post('/admin/posts/store', 'Admin\PostsController@store')->name('admin.posts.store');
Route::post('/admin/posts/{postId}/update', 'Admin\PostsController@update')->name('admin.posts.update');
Route::delete('/admin/posts/{postId}/delete', 'Admin\PostsController@delete')->name('admin.posts.delete');

Auth::routes();

