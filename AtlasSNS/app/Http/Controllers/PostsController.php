<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Post;

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
        return view('posts.index')->withErrors($errors);
        } else {
        // バリデーション成功の場合の処理
        $userId = $request->user()->id;

        Post::create([
            'post' => $request->input('post_content'),
            'user_id' => $userId,
        ]);

        return redirect('/top');
        }
    }

    // 更新ボタンを押したときの処理
    public function update(Request $request, $postId)
    {
        $request->validate([
            'post_content' => 'required|string|max:150',
        ]);

        $post = Post::find($postId);
        $post->post = $request->input('post_content');
        $post->save();

        return redirect()->route('posts.index')->with('success', '投稿が更新されました。');
    }

    // 削除ボタンを押したときの処理
   public function delete($id)
    {
        // POSTテーブルにある対象の$idを見つけて(find)->deleteで消す
        Post::find($id)->delete();
        return redirect('/top');
    }

}
