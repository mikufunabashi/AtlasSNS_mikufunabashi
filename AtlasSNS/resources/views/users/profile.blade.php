<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@extends('layouts.login')

@section('content')

<h>【ユーザープロフィール】</h>

<!-- フォロー相手のプロフィール画面 　自分のとユーザーとは別のviewファイルでやるの？設計書を見ると一緒になってない？-->
<div class="user-profile">
    <h1>{{ $user->username }}</h1>
    <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン">
    <!-- 🌟自己紹介設定後確認 -->
    <p>{{ $user->introduction }}</p>
    <!-- 🌟リターンで検索に飛ぶ -->
    @if (auth()->user()->isFollowing($user->id))
      <a href="{{ route('unfollow', ['userId' => $user->id]) }}" class="btn btn-danger">フォロー解除</a>
      @else
      <a href="{{ route('follow', ['userId' => $user->id]) }}" class="btn btn-info">フォローする</a>
    @endif
</div>

 <h1>【{{ $user->username }}の投稿一覧】</h1>

    @foreach ($user->post as $post)
        <div class="post">
            <img src="{{ asset('images/' . $post->user->images) }}" alt="ユーザーアイコン">
            <p>ユーザー名: {{ $post->user->username }}</p>
            <p>投稿内容: {{ $post->post }}</p>
            <p>投稿日時: {{ $post->created_at }}</p>
        </div>
    @endforeach

@endsection
