@extends('layouts.login')

@section('content')
<form action="/userSearch" method="post">
    @csrf
    <input type="text" name="keyword" class="form" placeholder="ユーザー名">
    <button type="submit" class="btn btn-success">
      <img src="{{ asset('/images/search.png') }}" alt="search Icon">
    </button>
</form>

<!-- 全てのユーザーを表示させる -->

<!-- 表示の記述 -->
      @if(isset($users))
        @foreach($users as $user)
            <div class="user">
                <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン">
                <p>{{ $user->username }}</p>
                <!-- その他ユーザー情報の表示 -->
            </div>
        @endforeach
      @endif

@endsection
