@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<h2>新規ユーザー登録</h2>

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

{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
