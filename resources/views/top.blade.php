@guest
    <button><a href="{{ route('registerPage') }}">新規会員登録</a></button>
    <button><a href="{{ route('loginPage' )}}">ログイン</a></button>
@endguest

@auth
    <span>ようこそ{{ Auth::user()->name_sei }}様</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button>ログアウト</button>
    </form>
@endauth
