<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

//Route::get('/{id}', 'HomeController@index');

Route::resource('posts', 'PostsController');

// Route::get('posts', array('as' => 'posts.index', 'uses' => 'PostsController@index'));
// Route::get('post/create', array('as' => 'post.create', 'uses' => 'PostsController@create'));
// Route::post('post', array('as' => 'post.store', 'uses' => 'PostsController@store'));
// Route::get('post/{post_id}', array('as' => 'post.show', 'uses' => 'PostsController@show'));
// Route::get('post/{post_id}/edit', array('as' => 'post.edit', 'uses' => 'PostsController@edit'));
// Route::put('post/{post_id}', array('as' => 'post.update', 'uses' => 'PostsController@update'));
// Route::delete('post/{post_id}', array('as' => 'post.destroy', 'uses' => 'PostsController@destroy'));

Route::resource('categories', 'CategoriesController');
Route::get('categories/{category_id}/move/{move}', array('as' => 'categories.order', 'uses' => 'CategoriesController@change_category_order'));

Route::resource('posts.comments', 'CommentsController');
// Route::get('post/{post_id}/comments', array('as' => 'post.comments.index', 'uses' => 'CommentsController@index'));
// Route::get('post/{post_id}/comment/create', array('as' => 'post.comment.create', 'uses' => 'CommentsController@create'));
// Route::post('posts/{post_id}/comments', array('as' => 'post.comment.store', 'uses' => 'CommentsController@store'));
// Route::get('post/{post_id}/comment/{comment_id}', array('as' => 'post.comment.show', 'uses' => 'CommentsController@show'));
// Route::get('post/{post_id}/comment/{comment_id}/edit', array('as' => 'post.comment.edit', 'uses' => 'CommentsController@edit'));
// Route::put('post/{post_id}/comment/{comment_id}', array('as' => 'post.comment.update', 'uses' => 'CommentsController@update'));
// Route::delete('post/{post_id}/comment/{comment_id}', array('as' => 'post.comment.destroy', 'uses' => 'CommentsController@destroy'));  

