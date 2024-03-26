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
        // 以下の記述でユーザー検索ボタンを押した時すでに、空の検索をかけていてそこからユーザー全てを表示している記述
        // ユーザーをすべて取得
        $users = User::where('id', '!=', auth()->user()->id)->get();

        // 検索ワードの初期化
        $keyword = '';

        // 検索結果が空の場合検索ワードを表示
        $searchWord = '';
        if (!$users->isEmpty()) {
        $searchWord = $keyword;
        }

         return view('users.search', ['users' => $users, 'keyword' => $keyword]);
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

        // 画像のパスを初期化せず、現在の画像パスを保持する
        $user = auth()->user();
        $images = $user->images;

        if ($request->hasFile('images')) {
            $filename = $request->file('images')->getClientOriginalName();
            $request->file('images')->move(public_path('images'), $filename);
            $images = $filename;
        }

        // ユーザー情報を更新する
        $user->username = $validatedData['username'];
        $user->mail = $validatedData['mail'];
        $user->password = Hash::make($validatedData['password']);
        $user->bio = $validatedData['bio'];
        $user->images = $images; // 更新後の画像情報

        if ($user->save()) {
            return redirect('/top')->with('success', 'プロフィールが更新されました');
        } else {
            return redirect('/top')->with('error', 'プロフィールの更新に失敗しました');
        }
    }



//     public function updateProfile(Request $request)
//     {
//         $validatedData = $request->validate([
//             'username' => 'required|max:12|min:2',
//             'mail' => 'required|max:40|min:5|email|unique:users,mail,' . auth()->id(),
//             'password' => 'required|max:20|min:8|alpha_num|confirmed',
//             'password_confirmation' => 'required|max:20|min:8|alpha_num',
//             'bio' => 'nullable|max:150',
//             'images' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
//         ]);


//         if ($request->hasFile('images')) {
//             // 画像がアップロードされている場合は、保存処理を行う
//             $filename = $request->file('images')->getClientOriginalName();
//             // アップロードされた画像を public/images ディレクトリに保存する
//             $request->file('images')->move(public_path('images'), $filename);
//             // 保存した画像のファイル名をデータベースに保存
//             $validatedData['images'] = $filename;
//         } else {
//             // 画像がアップロードされなかった場合は、データベースに保存されたパスはそのまま利用される
//             $validatedData['images'] = ''; // または null; とすることもできます
//         }

//         // ユーザー情報を更新する
//         $id = auth()->id();
//         $username = $validatedData['username'];
//         $mail = $validatedData['mail'];
//         $password = Hash::make($validatedData['password']);
//         $bio = $validatedData['bio'];
//         $images = $validatedData['images']; // 画像のパス

//         if (User::where('id', $id)->update([
//             'username' => $username,
//             'mail' => $mail,
//             'password' => $password,
//             'bio' => $bio,
//             'images' => $images
//         ])) {
//             return redirect('/top')->with('success', 'プロフィールが更新されました');
//         } else {
//             return redirect('/top')->with('error', 'プロフィールの更新に失敗しました');
//         }
//         dd($images);
//     }
}
