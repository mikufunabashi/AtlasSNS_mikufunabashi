@extends('layouts.login')

@section('content')

<h1>【ログインユーザープロフィール】</h1>
<div class="container">
    <div class="update">
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
        <img class="update-icon" src="{{ asset('images/' . Auth::user()->images) }}">
        <div class="update-form">
            <div class="update-block">
                <label for="name">user name</label>
                <input type="text" name="username" value="{{Auth::user()->username}}">
            </div>
            <div class="update-block">
                <label for="mail">mail address</label>
                <input type="email" name="mail" value="{{Auth::user()->mail}}">
            </div>
            <div class="update-block">
                <label for="pass">password</label>
                <input type="password" name="password">
            </div>
            <div class="update-block">
                <label for="pass-confirm">password confirm</label>
                <input type="password" name="password_confirmation">
            </div>
            <div class="update-block">
                <label for="name">bio</label>
                <input type="text" name="bio" value="{{Auth::user()->bio}}">
            </div>
            <div class="update-block">
                <label for="name">icon image</label>
                <input type="file" name="images">
            </div>
            <input type="submit" class="btn btn-danger">
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
