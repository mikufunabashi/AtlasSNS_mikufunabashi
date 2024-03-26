


@extends('layouts.login')


@section('content')
@error('post_content')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
 <!-- ログイン中のユーザーアイコンを表示 -->
    <div class="post-top">
            @if(Auth::user()->images)
                <img class="user_icon" src="{{ asset('images/' . Auth::user()->images) }}">
                @else
                <!-- デフォルトの画像または空の値を表示 -->
                <img class="user_icon" src="{{ asset('/images/icon1.png') }}">
            @endif

        <form action="/post" method="post" class="post-form">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <textarea name="post_content" id="post_content" rows="3" cols="50" placeholder="投稿内容を入力してください。"></textarea>
            <input type="image" src="{{ asset('/images/post.png') }}"></input>
        </form>
    </div>

    @foreach ($posts->sortByDesc('created_at') as $post)
        <div class="post-all">
            <div class="user-icon">
              @if ($post->user->images)
                 <img src="{{ asset('images/' . $post->user->images) }}">
                 @else
                 <img class="update-icon" src="{{ asset('images/icon1.png') }}">
              @endif
            </div>
            <div class="post-name">
                <span class="post-username">{{ $post->user->username }}</span>
                <p style="white-space:pre-wrap;">{{ $post->post }}</p>
            </div>
            <div class="post-other">
                <p class="day">{{ $post->created_at->format('Y-m-d H:i') }}</p>
                <!-- 編集ボタンを追加 -->
                <div class="post-btn">
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
                </div>
            </div>
        </div>

            <!-- 編集モーダルの記述 -->
        <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body1">
                            <!-- 編集フォームの内容をここに追加 -->
                            <form action="{{ route('posts.update', $post->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                @error('edit_post_content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <textarea name="post_content" id="post_content_modal" rows="4" cols="50">{{ $post->post }}</textarea>
                                <div class="updateButton">
                                    <button type="submit">
                                    <img src="{{ asset('/images/edit.png') }}" alt="Edit Icon" style="cursor: pointer;">
                                    </button>
                                </div>
                            </form>
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
