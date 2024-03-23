<!-- Bootstrap CSS 🌟これらはここに入れていいの？ -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
<link rel="stylesheet" href="{{ asset('css/logout.css') }} ">

@extends('layouts.logout')

@section('content')

<div id="clear">
   <div class="youkoso">
      <p>{{session('username')}}さん</p>
      <div class="youkoso2">
        <p>ようこそ！AtlasSNSへ！</p>
      </div>
  </div>
  <div class="clear-p">
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>
  </div>
  <div class="clear-btn">
    <p class="btn btn-danger"><a class="login-font" href="/login">ログイン画面へ</a></p>
  </div>
</div>

@endsection
