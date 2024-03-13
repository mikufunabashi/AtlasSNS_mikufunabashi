<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
        <!--IEブラウザ対策-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="ページの内容を表す文章" />
        <title></title>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ asset('/js/script.js') }}"></script>
        <!-- Bootstrap CSS 🌟これらはここに入れていいの？-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!--スマホ,タブレット対応-->
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <!--サイトのアイコン指定-->
        <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
        <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
        <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
        <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
        <!--iphoneのアプリアイコン指定-->
        <link rel="apple-touch-icon-precomposed" href="画像のURL" />
        <!--OGPタグ/twitterカード-->
        <!-- head タグ内 -->

    </head>
    <body>
        <header>
            <div class="top_head">
                <!-- トップに戻るURL間違っているかも、確認できなかった -->
                <!-- なぜassetじゃないとできないの？ -->
                <a href="http://127.0.0.1:8000/top"><img class="logo" src="{{ asset('/images/atlas.png') }}"></a>
                <div id="side_user">
                    <!-- Auth::userはログインしている人のという意味 -->
                    <div class="user_name">{{ Auth::user()->username }}さん
                        <div class="arrow-icon"></div>
                        @if(Auth::user()->images)
                            <img class="user_icon" src="{{ asset('images/' . Auth::user()->images) }}">
                            @else
                            <!-- デフォルトの画像または空の値を表示 -->
                            <img class="user_icon" src="{{ asset('/images/icon1.png') }}">
                        @endif
                    </div>
                </div>
                    <!-- 🌟/topのアコーディオンメニューだけ機能していない、今まではできていた -->
            </div>
                    <div class="according-menu">
                        <ul class="kodomo">
                            <li><a class="home" href="/top">ホーム</a></li>
                            <li><a class="profile" href="/myprofile">プロフィール編集</a></li>
                            <li><a class="center" href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
            </div>
        </header>
        <div id="row">
            <div id="container">
                @yield('content')
            </div >
            <div id="side-bar">
                <div id="confirm">
                    <p>{{ Auth::user()->username }}さんの</p>
                    <div class="follow-count">
                        <p>フォロー数</p>
                        <p class="count">{{ Auth::user()->followingCount() }}名</p>
                    </div>
                    <div class="count-btn">
                        <a href="/follow-list" ctype="button" class="btn btn-primary">フォローリスト</a>
                    </div>
                    <div class="follow-count">
                        <p>フォロワー数</p>
                        <p class="count">{{ Auth::user()->followerCount() }}名</p>
                    </div>
                    <div class="count-btn">
                        <a href="/follower-list" type="button" class="btn btn-primary">フォロワーリスト</a>
                    </div>
                </div>
                <div class="search-btn">
                    <a href="/search" type="button" class="btn btn-primary">ユーザー検索</a>
                </div>
            </div>
        </div>
        <footer>
        </footer>


    </body>
</html>
