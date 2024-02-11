<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.myprofile');
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
        return view('users.search',['users' => $users,'keyword' => $keyword]);
    }

    // ユーザープロフィールに飛ぶ記述
    public function userProfile($userId)
    {
        // ユーザーIDを元にユーザーデータを取得
        $user = User::find($userId);
        return view('users.profile', compact('user'));
    }

    public function profilePosts($userId)
    {
        // ユーザーIDを元にユーザーデータを取得
        $user = User::with('posts.user')->find($userId);
        return view('profile', compact('user'));
    }

    // プロフィール編集機能の記

    public function updateProfile(Request $request)
    {
    // バリデーションの実行
    $validatedData = $request->validate([
        'username' => 'required|max:12|min:2',
        'mail' => 'required|max:40|min:5|email|unique:users,mail,' . auth()->id(),
        'password' => 'required|max:20|min:8|alpha_num|confirmed',
        'password_confirmation' => 'required|max:20|min:8|alpha_num',
        'bio' => 'nullable|max:150',
        'images' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
    ]);

    // 画像がアップロードされたかどうかを確認
    if ($request->hasFile('images')) {
        // 画像がアップロードされている場合は、保存処理を行う
        // 保存先パスを生成
        $path = $request->file('images')->store('profile_images', 'public');

        // 画像のパスをデータベースに保存する
        $validatedData['images'] = $path;
    }

    // ユーザー情報を更新する
    $id = auth()->id();
    $username = $validatedData['username'];
    $mail = $validatedData['mail'];
    $password = Hash::make($validatedData['password']);
    $bio = $validatedData['bio'];
    $images = $validatedData['images']; // 画像のパス

    User::where('id', $id)->update([
        'username' => $username,
        'mail' => $mail,
        'password' => $password,
        'bio' => $bio,
        'images' => $images
    ]);

    return redirect('/top');
    }




}
