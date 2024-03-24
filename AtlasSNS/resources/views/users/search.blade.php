<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@extends('layouts.login')

@section('content')
  <div class="search-area">
    <form action="/search" method="post">
        @csrf
        <input type="text" name="keyword" class="form" placeholder="ユーザー名">
        <button  class="search-btn1" type="submit">
          <img src="{{ asset('/images/search.png') }}" alt="search Icon">
        </button>
    </form>
    <!-- 検索ワードの表示 -->
    @if (!empty($keyword))
      <p class="searchWord">検索ワード: {{ $keyword }}</p>
    @endif
  </div>

  <!-- 表示の記述 -->
  <div class="search-users">
    @if(isset($users))
      @foreach($users as $user)
          <div class="user">
            <div class="user-icon2">
              @if ($user->images)
                  <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン">
              @else
                  <img src="{{ asset('images/icon1.png') }}">
              @endif
            </div>
            <p class="search-username">{{ $user->username }}</p>
            <div class="search-btn2">
              @if (auth()->user()->isFollowing($user->id))
                <a href="{{ route('unfollow', ['userId' => $user->id]) }}" class="btn btn-danger">フォロー解除</a>
              @else
                <a href="{{ route('follow', ['userId' => $user->id]) }}" class="btn btn-info">フォローする</a>
              @endif
            </div>
          </div>
      @endforeach
    @endif
  </div>


@endsection
