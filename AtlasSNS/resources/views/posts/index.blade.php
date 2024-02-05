


@extends('layouts.login')


@section('content')

 <!-- ログイン中のユーザーアイコンを表示 -->
    @if(Auth::check())
        <div class="user-icon">
            <img src="{{ asset('images/' . Auth::user()->images) }}">
        </div>
    @endif

  <form action="/post" method="post">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <textarea name="post_content" id="post_content" rows="4" cols="50" placeholder="投稿内容を入力してください。"></textarea>
    <input type="image" src="{{ asset('/images/post.png') }}"></input>
  </form>

    @foreach ($posts as $post)
        <div class="post">
            <p>{{ $post->post }}</p>
            <div class="user-icon">
              <!-- ユーザーアイコンの表示 🌟ユーザーとユーザー画像を一致させる設定をどこかに記入しないいけない-->
              <img src="{{ asset('images/' . $post->user->images) }}">
              <span>{{ $post->user->username }}</span>
            </div>
            <p class="day">{{ $post->created_at->format('Y-m-d H:i') }}</p>
            <!-- 編集ボタンを追加 -->
            @if(Auth::check() && $post->user->id == Auth::user()->id)
            <a type="button" data-toggle="modal" data-target="#editModal{{ $post->id }}">
                <img src="{{ asset('/images/edit.png') }}" alt="Edit Icon">
            </a>
            @endif
            <!-- 削除ボタン -->
            @if(Auth::check() && $post->user->id == Auth::user()->id)
            <!-- {{$post->id}} $postには投稿の全ての情報が入っている、この記述にすると＄postのIDだけ抽出できる -->
            <a class="trashIcon" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                <span class="icon-text">削除</span>
            </a>
            @endif

            <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                          <!-- ↓閉じる×マークの記述。不要なら削除 -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- 編集フォームの内容をここに追加 -->
                            <form action="{{ route('posts.update', $post->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <textarea name="post_content" id="post_content_modal" rows="4" cols="50">{{ $post->post }}</textarea>
                                <button type="submit" id="updateButton">
                                  <img src="{{ asset('/images/edit.png') }}" alt="Edit Icon" style="cursor: pointer;">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
    @endforeach


@endsection

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
