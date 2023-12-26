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
            <div id="head">
                <!-- トップに戻るURL間違っているかも、確認できなかった -->
                <!-- なぜassetじゃないとできないの？ -->
                <h1><a id='logo' href="http://127.0.0.1:8000/top"><img src="{{ asset('/images/atlas.png') }}"></a></h1>
                <div id="side_user">
                    <div class="icon">
                        <!-- Auth::userはログインしている人のという意味 -->
                        <p>{{ Auth::user()->username }}さん<img src="{{ asset('images/' . Auth::user()->images) }}"></p>
                        <div class="arrow-icon"></div>
                    </div>
                    <!-- 🌟/topのアコーディオンメニューだけ機能していない、今まではできていた -->
                    <div class="according-menu">
                        <ul class="kodomo">
                            <li><a class="home" href="/top">ホーム</a></li>
                            <li><a class="profile" href="/profile">プロフィール編集</a></li>
                            <li><a class="center" href="/logout">ログアウト</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div id="row">
            <div id="container">
                @yield('content')
            </div >
            <div id="side-bar">
                <div id="confirm">
                    <p>〇〇さんの</p>
                    <div>
                    <p>フォロー数</p>
                    <p>名</p>
                    </div>
                    <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                    <div>
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                    </div>
                    <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                </div>
                <p class="btn"><a href="/search">ユーザー検索</a></p>
            </div>
        </div>
        <footer>
        </footer>


    </body>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('/js/script.js') }}"></script>
