
<link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
<link rel="stylesheet" href="{{ asset('css/logout.css') }} ">


@extends('layouts.logout')

  @section('content')
  <div class="form-top">
    <!-- 適切なURLを入力してください -->
    {!! Form::open(['url' => '/login']) !!}

    <p class="youkoso">AtlasSNSへようこそ</p>

    <div class="email">
      <p class="small1">メールアドレス</p>
      {{ Form::text('mail',null,['class' => 'form-input']) }}
    </div>
    <div class="email">
      <p class="small1">パスワード</p>
      {{ Form::password('password',['class' => 'form-input']) }}
    </div>

    <div class="top-btn">
      {{ Form::submit('LOGIN',['class' => 'btn btn-danger']) }}
    </div>

    <div class="link-light">
      <a href="/register" class="user-link">新規ユーザーの方はこちら</a>
    </div>

    {!! Form::close() !!}
  </div>

  @endsection
