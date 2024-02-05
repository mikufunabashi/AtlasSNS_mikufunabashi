@extends('layouts.login')

@section('content')
    <!-- フォローしている人のアイコン一覧 -->
<div class="">
    <h1>[ フォローユーザーアイコン一覧 ]</h1>
    <div class="user-icon">
        @foreach ($followerUsers as $user)
            <div>
                <a href="{{ route('user.profile', ['userId' => $user->id]) }}">
                  <img src="{{ asset('images/' . $user->images) }}" alt="フォロワーアイコン">
                </a>
            </div>
        @endforeach
    </div>
</div>

<div class="">
    <h1>[ フォロワーリスト ]</h1>
    <div class="user-icon">
        @foreach ($posts as $post)
            <div>
                <a><img src="{{ asset('images/' . $post->user->images) }}" alt="フォロワーアイコン"></a>
                <p>ユーザー名: {{ $post->user->username }}</p>
                <p>投稿内容: {{ $post->post }}</p>
                <p>投稿日時: {{ $post->created_at }}</p>
            </div>
        @endforeach
    </div>
</div>

@endsection
