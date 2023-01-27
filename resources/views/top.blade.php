@guest
    <span>新規会員登録</span>
    <button><a herf="{{ route('loginPage' )}}"></a>ログイン</button>
@endguest

@auth
    <span>ようこそ{{ Auth::user()->username }}様</span>
    <button><a href="">ログアウト</a></button>
@endauth
