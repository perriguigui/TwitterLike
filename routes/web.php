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

Route::get('/home', 'PostController@index')->name('home');

Route::resource('post','PostController');
Route::post('/like','PostController@likePost')->name('like');
Route::post('/createpost', 'PostController@postCreatePost')->middleware('auth')->name('post.create');
Route::post('/edit','PostController@postEditPost')->name('edit');
Route::get('/delete-post/{post_id}', 'PostController@getDeletePost')->middleware('auth')->name('post.delete');
Route::get('profile/{user}', 'UserController@show')->name('profile.show');
Route::get('profile/{user}/edit', 'UserController@edit')->middleware('auth')->name('profile.edit');
Route::patch('profile/{user}', 'UserController@update')->middleware('auth')->name('profile.update');
Route::get('/retweet', 'RetweetController@retweet')->name('retweet');
Route::get('profile/{profileId}/follow', 'UserController@followUser')->name('user.follow');

Route::get('/{profileId}/unfollow', 'UserController@unFollowUser')->name('user.unfollow');



Route::get('/search', 'SearchController@search')->name('search');
