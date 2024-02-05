@extends('layouts.login')

@section('content')

<h>ユーザープロフィール</h>
<!-- 自分のプロフィール画面 -->

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

@endsection
