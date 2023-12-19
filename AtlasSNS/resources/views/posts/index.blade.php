<!-- BootstrapのCSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>

 <!-- ログイン中のユーザーアイコンを表示 -->
    @if(Auth::check())
        <div class="user-icon">
            <img src="{{ asset('images/' . Auth::user()->icon) }}" alt="{{ Auth::user()->username }}のアイコン">
        </div>
    @endif

<form action="/post" method="post">
  @csrf
  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
  <textarea name="post_content" id="post_content" rows="4" cols="50"></textarea>
  <input type="image" src="{{ asset('/images/post.png') }}"></input>
</form>

<!-- 編集ボタン -->
    @foreach ($posts as $post)
        <div class="post">
            <p>{{ $post->post }}</p>
            <!-- 編集ボタンを追加 -->
            <!-- これを押したらモーダルが開くボタンに変える -->
            @if(Auth::check() && $post->user->id == Auth::user()->id)
            <a type="button" data-toggle="modal" data-target="#editModal{{ $post->id }}">
                <img src="{{ asset('/images/edit.png') }}" alt="Edit Icon">
            </a>
            @endif
            <!-- 削除ボタン -->
            @if(Auth::check() && $post->user->id == Auth::user()->id)
            <a type="button" class="btn-delete" data-postid="{{ $post->id }}">
                <img src="{{ asset('/images/trash.png') }}" alt="trash Icon">
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

            <!-- 削除確認モーダル -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">投稿を削除しますか？</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>この操作は取り消せません。本当に削除しますか？</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                  <button type="button" class="btn btn-danger" id="confirmDelete">削除する</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endforeach

@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('/js/script.js') }}"></script>
