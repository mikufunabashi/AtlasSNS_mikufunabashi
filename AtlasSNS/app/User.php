<?php
// User.phpはモデルで、これを使ってuserテーブルと繋げる

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 投稿フォーム 🌟ここhasoneじゃない
    public function post(){
        return $this->hasMany('App\Post');
    }

    // userAとuserBをつなげるリレーションを２つ　🌟時間ある時読み解く
    public function follows()
    {
        return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    }
    public function follower()
    {
        return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    }

    // フォローしているか
    // $user_id はログイン中のユーザー
    public function isFollowing(Int $user_id)
    {
        return (bool) $this->follows()->where('followed_id', $user_id)->first();
    }

    // フォロー数とフォロワー数の表示
    public function followingCount()
    {
    return $this->follows()->count();
    }

    public function followerCount()
    {
    return $this->follower()->count();
    }



}
