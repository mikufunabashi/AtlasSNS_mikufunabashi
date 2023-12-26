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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('miku');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

Route::group(['middleware' => ['loginUserCheck']], function() {
//ログイン中のページ
// もしかして↓これpostのルーティング？その場合getではなくpostでは？
  Route::get('/top','PostsController@index');

  Route::get('/profile','UsersController@profile');

  Route::get('/search','UsersController@user_search');

  Route::get('/follow-list','FollowsController@followList');
  Route::get('/follower-list','FollowsController@followerList');

  // 投稿フォームのルーティング必要？
  Route::post('/post','PostsController@postCreate');
  // 投稿編集のルーティング
  Route::put('/posts/{postId}', 'PostsController@update')->name('posts.update');
  Route::get('/posts', 'PostsController@index')->name('posts.index');
  // 投稿削除のルーティング
  // {{$post->id}}はindexの方でIDを取得済みなので、ここでは何かしらのidがくるよという記述でおk
  Route::get('/post/{id}/delete','PostsController@delete');

  // ユーザー検索
  Route::post('/userSearch','UsersController@user_search');



  // ログアウト
  Route::get('/logout','Auth\LoginController@logout');

});
