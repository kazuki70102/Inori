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

// トップ
Route::get('/', function () {
    return view('welcome');
});

// 利用規約・プライバシーポリシー
Route::get('terms', function () {
    return view('terms');
});

Route::get('privacy', function () {
    return view('privacy');
});


// 認証系
Auth::routes(['verify' => true]);
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// 投稿
Route::get('posts/driver', 'PostsController@driver')->name('posts.driver');
Route::get('posts/rider', 'PostsController@rider')->name('posts.rider');



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
    Route::get('profile/{user}/follows', 'ProfilesController@follows')->name('follows');
    Route::get('profile/{user}/followers', 'ProfilesController@followers')->name('followers');
    Route::get('profile/{user}', 'ProfilesController@show')->name('profile.show');
    Route::get('profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
    Route::patch('profile/{user}/edit', 'ProfilesController@update')->name('profile.update');

    // 投稿
    Route::resource('posts', 'PostsController', [
        'except' => ['destroy']
    ]);
    Route::get('posts/{post}/delete', 'PostsController@destroy')
        ->name('posts.destroy');

    // コメント
    Route::resource('comments', 'CommentController', [
        'only' => ['store']
    ]);

    // マッチ
    Route::get('matches', 'MatchUserController@index')->name('matches.index');
    Route::post('matches', 'MatchUserController@store')->name('matches.store');

    // チャット
    Route::get('messages', 'MessagesController@index');
    Route::post('messages', 'MessagesController@store');
    Route::get('messages/{matchId}', 'MessagesController@show')->name('messages.show');


});
