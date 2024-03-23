<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/reset.css') }} ">

@extends('layouts.logout')

@section('content')
<div class="form-top1">
  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => '/register']) !!}

  <h2 class="youkoso">新規ユーザー登録</h2>

  @if ($errors->has('username'))
  <div>
    @foreach($errors->get('username') as $message)
    <td> {{ $message }} </td>
    @endforeach
  </div>
  @endif

  @if ($errors->has('mail'))
  <div>
    @foreach($errors->get('mail') as $message)
    <td> {{ $message }} </td>
    @endforeach
  </div>
  @endif

  @if ($errors->has('password'))
  <div>
    @foreach($errors->get('password') as $message)
    <td> {{ $message }} </td>
    @endforeach
  </div>
  @endif

  @if ($errors->has('password_confirmation'))
  <div>
    @foreach($errors->get('password_confirmation') as $message)
    <td> {{ $message }} </td>
    @endforeach
  </div>
  @endif

  <div class="email">
    <p class="small1">ユーザー名</p>
    {{ Form::label('ユーザー名') }}
    {{ Form::text('username',null,['class' => 'form-input']) }}
  </div>

  <div class="email">
    <p class="small1">メールアドレス</p>
    {{ Form::label('メールアドレス') }}
    {{ Form::text('mail',null,['class' => 'form-input']) }}
  </div>

  <div class="email">
    <p class="small1">パスワード</p>
    <label for="password"></label>
    <input id="password" type="password" name="password" class="form-input">
  </div>

  <div class="email">
    <p class="small1">パスワード確認</p>
    <label for="password_confirmation"></label>
    <input id="password_confirmation" type="password" name="password_confirmation" class="form-input">
  </div>

  <div class="top-btn">
    {{ Form::submit('REGISTER',['class' => 'btn btn-danger']) }}
  </div>

  <div class="link-light">
    <p><a href="/login" class="user-link">ログイン画面へ戻る</a></p>
  </div>

  {!! Form::close() !!}
</div>

@endsection
