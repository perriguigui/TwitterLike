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

Route::get('profile/{user}', 'UserController@show')->name('profile.show');
Route::get('profile/{user}/edit', 'UserController@edit')->middleware('auth')->name('profile.edit');
Route::patch('profile/{user}', 'UserController@update')->middleware('auth')->name('profile.update');

Route::get('profile/{profileId}/follow', 'UserController@followUser')->name('user.follow');

Route::get('/{profileId}/unfollow', 'UserController@unFollowUser')->name('user.unfollow');


Route::post('/search', 'HomeController@search')->name('search');
Route::get('/companies/{company}', 'CompanyController@show')->name('companies.show');
Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');