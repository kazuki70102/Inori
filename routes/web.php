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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');



Route::middleware('verified')->group(function() {
    // 本登録しているユーザーだけ表示
    Route::post('follow/{user}', 'FollowUserController@store')->middleware('dontself');

    Route::get('requests', 'RequestUserController@index')->name('requests.index');
    Route::post('requests/{user}', 'RequestUserController@store')->middleware('dontself');

    Route::get('profile', 'ProfilesController@index')->name('profile.index');
    Route::get('profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
    Route::patch('profile/{user}/edit', 'ProfilesController@update')->name('profile.update');

    Route::get('posts/driver', 'PostsController@driver')->name('posts.driver');
    Route::get('posts/rider', 'PostsController@rider')->name('posts.rider');
    Route::resource('posts', 'PostsController', [
        'except' => ['index', 'destroy']
    ]);
    Route::get('posts/{post}/delete', 'PostsController@destroy')->name('posts.destroy');

    Route::get('messages/index', 'MessagesController@index');
    Route::get('ajax/messages', 'Ajax\MessagesController@index');
    Route::post('ajax/messages', 'Ajax\MessagesController@create');


});
