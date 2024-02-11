<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use App\Follow;
use App\Post;
use Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        // $user = auth()->user();
        return view('follows.followList');
    }
    public function followerList(){
        // $user = auth()->user();
        return view('follows.followerList');
    }
    // 🌟時間ある時に読み解く
    public function follow($userId)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($userId);

        // フォローしていなかったら下記のフォロー処理を実行
        if (!$is_following) {
            // 自分のユーザーIDを取得
            $loggedInUserId = auth()->user()->id;
            // フォローしたい人のユーザーIDを元にユーザーを取得
            $followedUser = User::find($userId);
            $followedUserId = $followedUser->id;

            // フォローデータをデータベースに登録
            Follow::create([
                'following_id' => $loggedInUserId,
                'followed_id' => $followedUserId,
            ]);
            return back();
        }

    }

    public function unfollow($userId)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($userId);

        // フォローしていれば下記のフォロー解除を実行する
        if ($is_following) {

            $loggedInUserId = auth()->user()->id;
            Follow::where([
                ['followed_id', '=', $userId],
                ['following_id', '=', $loggedInUserId],
            ])
                ->delete();
        }
            return back();
    }

    // フォローしている投稿内容などを表示する記述　🌟ビューも記載する
    public function showFollowedUsers()
    {
        // ログインしているユーザーがフォローしているユーザーを取得
        $followedUsers = Auth::user()->follows;

        // 各投稿ごとにユーザーを取得
        $posts = Post::with('user')->whereIn('user_id', $followedUsers->pluck('id'))->get();

        return view('follows.followList', compact('followedUsers','posts'));
    }

    // フォローされている投稿内容などを表示する記述
    public function showFollowerUsers()
    {
        // ログインしているユーザーがフォローされているユーザーを取得
        $followerUsers = Auth::user()->follower;
        // dd($followerUsers);
        $posts = Post::with('user')->whereIn('user_id', $followerUsers->pluck('id'))->get();

        return view('follows.followerList', compact('followerUsers','posts'));
    }

}
