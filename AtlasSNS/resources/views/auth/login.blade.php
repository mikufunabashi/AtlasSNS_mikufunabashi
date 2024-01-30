<!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}


<p>AtlasSNSへようこそ</p>

<div class="email">
  <div class="small">
  {{ Form::label('mail sdress') }}
  </div>
  {{ Form::text('mail',null,['class' => 'input']) }}
</div>
<div class="password">
  <div class="small">
  {{ Form::label('password') }}
  </div>
  {{ Form::password('password',['class' => 'input']) }}
</div>

{{ Form::submit('LOGIN',['class' => 'btn btn-danger']) }}

<p><a href="/register" class=link-light>新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
