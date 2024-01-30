@extends('layouts.login')

@section('content')
  @foreach ($followedUsers ?? [] as $user)
    <div class="user-icon">
      <img src="{{ asset('storage/'.$follow->images) }}">
      <span>{{ $user->username }}</span>
    </div>
  @endforeach

@endsection
