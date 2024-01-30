<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@extends('layouts.login')

@section('content')
  <form action="/userSearch" method="post">
      @csrf
      <input type="text" name="keyword" class="form" placeholder="ユーザー名">
      <button type="submit">
        <img src="{{ asset('/images/search.png') }}" alt="search Icon">
      </button>
  </form>


  <!-- 検索ワードの表示 -->
  @if(isset($keyword))
    <p class="searchWord">検索ワード: {{ $keyword }}</p>
  @endif

  <!-- 表示の記述 -->
  @if(isset($users))
    @foreach($users as $user)
        <div class="user">
            <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン">
            <p>{{ $user->username }}</p>
        </div>
        @if (auth()->user()->isFollowing($user->id))
          <a href="{{ route('unfollow', ['userId' => $user->id]) }}" class="btn btn-danger">フォロー解除</a>
        @else
          <a href="{{ route('follow', ['userId' => $user->id]) }}" class="btn btn-info">フォローする</a>
        @endif
    @endforeach
  @endif






@endsection
