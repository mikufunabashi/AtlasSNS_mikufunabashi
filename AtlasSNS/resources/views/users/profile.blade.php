<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@extends('layouts.login')

@section('content')

<!-- フォロー相手のプロフィール画面 　自分のとユーザーとは別のviewファイルでやるの？設計書を見ると一緒になってない？-->
<div class="user-profile">
    <div class="user-icon2">
        @if ($user->images)
            <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン">
        @else
            <img src="{{ asset('images/icon1.png') }}">
        @endif
    </div>
    <div class="user-bio">
        <div class="user-bio1">
            <p class="bio-font">ユ-ザ-名</p>
            <p class="bio-font1">{{ $user->username }}</p>
        </div>
        <div class="user-bio1">
            <p class="bio-font">自己紹介</p>
            <p class="bio-font1">{{ $user->bio }}</p>
        </div>
    </div>
    <div class="profile-btn">
        @if (auth()->user()->isFollowing($user->id))
        <a href="{{ route('unfollow', ['userId' => $user->id]) }}" class="btn btn-danger">フォロー解除</a>
        @else
        <a href="{{ route('follow', ['userId' => $user->id]) }}" class="btn btn-info">フォローする</a>
        @endif
    </div>
</div>


    @foreach ($user->post()->orderBy('created_at', 'desc')->get() as $post)
        <div class="post-all">
            <div class="user-icon">
                @if ($post->user->images)
                <img src="{{ asset('images/' . $post->user->images) }}">
                @else
                <img class="update-icon" src="{{ asset('images/icon1.png') }}">
                @endif
            </div>
            <div class="post-name">
                <p class="post-username">{{ $post->user->username }}</p>
                <p>{{ $post->post }}</p>
            </div>
            <p class="post-other">{{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>
    @endforeach

@endsection
