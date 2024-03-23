<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/reset.css') }} ">

@extends('layouts.login')

@section('content')

    <div class="my-profile">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['url' => '/profile/update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            {{Form::hidden('id',Auth::user()->id)}}
            <div class="update-form">
                @if(Auth::user()->images)
                    <img class="user_icon" src="{{ asset('images/' . Auth::user()->images) }}">
                    @else
                    <!-- デフォルトの画像または空の値を表示 -->
                    <img class="user_icon" src="{{ asset('/images/icon1.png') }}">
                @endif
                <div class="update-content">
                    <div class="update-block">
                        <label for="name">ユーザーネーム</label>
                        <input type="text" name="username" value="{{Auth::user()->username}}">
                    </div>
                    <div class="update-block">
                        <label for="mail">メールアドレス</label>
                        <input type="email" name="mail" value="{{Auth::user()->mail}}">
                    </div>
                    <div class="update-block">
                        <label for="pass">パスワード</label>
                        <input type="password" name="password">
                    </div>
                    <div class="update-block">
                        <label for="pass-confirm">パスワード確認</label>
                        <input type="password" name="password_confirmation">
                    </div>
                    <div class="update-block">
                        <label for="name">自己紹介</label>
                        <input type="text" name="bio" value="{{Auth::user()->bio}}">
                    </div>
                    <div class="update-block">
                        <div class="btn-form">
                            <p>アイコン画像</p>
                            <label for="update-btn">
                                <input type="file" id="update-btn" name="images">
                                <div class="form-input">ファイルを選択</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <input type="submit" class="btn btn-danger">
            </div>
            {!! Form::close() !!}
    </div>

@endsection
