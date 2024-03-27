<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Post;
use App\User;
use Auth;

class PostsController extends Controller
{
    //
    public function index()
    {
        $posts = Post::with('user')->get();
        // dd($posts);　何かわからなくなった使う
        return view('posts.index', compact('posts'));
    }

   // PostsController
    public function postCreate(Request $request)
    {
        // バリデーションルールの定義
        $rules = [
            'post_content' => 'required|string|min:1|max:150',
        ];

        // バリデーションの実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションエラーがある場合
        if ($validator->fails()) {
            // エラーメッセージ取得
            $errors = $validator->errors();

            // エラーがある場合の処理（エラーメッセージの表示など）
            return back()->withErrors($errors)->withInput();
        } else {
            // バリデーション成功の場合の処理
            $userId = $request->user()->id;

            Post::create([
                'post' => $request->input('post_content'),
                'user_id' => $userId,
            ]);

            // 投稿を取得
            $posts = Post::all();

            // 投稿をビューに渡す
            return back();
        }
    }

    // 更新ボタンを押したときの処理
    public function update(Request $request, $postId)
    {
        $request->validate([
            'edit_post_content' => 'required|string|min:1|max:150',
        ]);

        $post = Post::find($postId);
        $post->post = $request->input('edit_post_content');
        $post->save();

        // モーダル内でのエラーメッセージ表示用のビューを返す
        if ($request->has('from_modal')) {
            return response()->json(['errors' => ['edit_post_content' => '投稿の更新が失敗しました。']], 422);
        }

        // 通常のリクエストの場合は、投稿一覧ページにリダイレクトする
        return back();
    }






    // 削除ボタンを押したときの処理
   public function delete($id)
    {
        // POSTテーブルにある対象の$idを見つけて(find)->deleteで消す
        Post::find($id)->delete();
        return redirect('/top');
    }

    // フォローしているユーザーの投稿のみ表示
    public function show()
    {
    // フォローしているユーザーのIDを取得
    $following_id = Auth::user()->follows()->pluck('followed_id');

    // フォローしているユーザーのidを元に投稿内容を取得,orWhere（）で自分の投稿も取得している
    $posts = Post::with('user')->whereIn('user_id', $following_id)->orWhere('user_id', Auth::user()->id)->get();

    return view('posts.index', compact('posts'));
    }

}
