@extends('layouts.login')

@section('content')
    <!-- フォローしている人のアイコン一覧 -->
    <div class="follow-icon">
        <h1>フォローリスト</h1>
        <div class="user-icon1">
            @foreach ($followedUsers as $user)
                <div class="user-icon2">
                    <a href="{{ route('user.profile', ['userId' => $user->id]) }}">
                        @if ($user->images)
                        <img src="{{ asset('images/' . $user->images) }}" alt="フォローアイコン">
                        @else
                        <img src="{{ asset('images/icon1.png') }}" alt="デフォルトアイコン">
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <div class="">
        @foreach ($posts->sortByDesc('created_at') as $post)
            <div class="post-all">
                <div class="user-icon">
                    <a class="icon-url" href="{{  route('user.profile', ['userId' => $post->user->id]) }}">
                        @if ($post->user->images)
                            <img src="{{ asset('images/' . $post->user->images) }}" alt="投稿者のアイコン">
                            @else
                            <img src="{{ asset('images/icon1.png') }}">
                        @endif
                    </a>
                </div>
                <div class="post-name">
                    <span class="post-username">{{ $post->user->username }}</span>
                    <p style="white-space:pre-wrap;">{{ $post->post }}</p>
                </div>
                <p class="post-other">{{ $post->created_at->format('Y-m-d H:i') }}</p>
            </div>
        @endforeach
    </div>

@endsection
