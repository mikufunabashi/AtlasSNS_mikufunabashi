<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        return view('users.search');
    }

    // ログイン機能？
    public function users()
    {
        // ここに何か記入が必要な気がします！
        return view('posts.index');
    }

    // ユーザー検索の記述　🌟ここに記述であってる？
    public function user_search(Request $request)
    {
        // 1つ目の処理、$keywordにきちんとキーワードが入っているか
        $keyword = $request->input('keyword');
        // 2つ目の処理
        if(!empty($keyword)){
            // User::はUser.phpに行く記述
             $users = User::where('username','like', '%'.$keyword.'%')
             ->where('id', '!=', auth()->user()->id) // 自分以外のユーザーに絞り込み
             ->get();
        }else{
             $users = User::where('id', '!=', auth()->user()->id)->get();
        }
        // 3つ目の処理
        return view('users.search',['users' => $users]);
    }
}
