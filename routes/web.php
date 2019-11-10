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

    // フォロー
    Route::post('follow/{user}', 'FollowUserController@store')
        ->middleware('dontself');

    // リクエスト
    Route::get('requests', 'RequestUserController@index')
        ->middleware('driver')
        ->name('requests.index');
    Route::post('requests/{user}', 'RequestUserController@store')
        ->middleware('dontself')
        ->name('requests.store');
    Route::delete('requests/{user}', 'RequestUserController@destroy')
        ->middleware('driver')
        ->name('requests.destroy');

    // プロフィール
    Route::get('profile', 'ProfilesController@index')->name('profile.index');
    Route::get('profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
    Route::patch('profile/{user}/edit', 'ProfilesController@update')->name('profile.update');

    // 投稿
    Route::get('posts/driver', 'PostsController@driver')->name('posts.driver');
    Route::get('posts/rider', 'PostsController@rider')->name('posts.rider');
    Route::resource('posts', 'PostsController', [
        'except' => ['index', 'destroy']
    ]);
    Route::get('posts/{post}/delete', 'PostsController@destroy')
        ->middleware('dirver')
        ->name('posts.destroy');

    // マッチ
    Route::get('matches', 'MatchUserController@index')->name('matches.index');
    Route::post('matches', 'MatchUserController@store')->name('matches.store');

    // チャット
    Route::get('messages', 'MessagesController@index');
    Route::post('messages', 'MessagesController@store');
    Route::get('messages/{matchId}', 'MessagesController@show')->name('messages.show');


});
