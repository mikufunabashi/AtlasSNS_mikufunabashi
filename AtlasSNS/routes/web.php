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
  // フォローしているユーザーの投稿のみ表示
  Route::get('/top','PostsController@show');
  Route::get('/profile','UsersController@profile');

  Route::get('/search','UsersController@user_search');

  // フォロー、フォロワーリスト
  Route::get('/follow-list','FollowsController@showFollowedUsers');
  Route::get('/follower-list','FollowsController@showFollowerUsers');

  // ユーザープロフィールに飛ぶ記述
  Route::get('/profile/{userId}','UsersController@userProfile')->name('user.profile');

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

  // フォローとフォロー解除のルーティング
  Route::get('/follow/{userId}', 'FollowsController@follow')->name('follow');
  Route::get('/follow/{userId}/destroy', 'FollowsController@unfollow')->name('unfollow');


  // ログアウト
  Route::get('/logout','Auth\LoginController@logout');

});
