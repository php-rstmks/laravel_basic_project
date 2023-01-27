@guest
    <span>新規会員登録</span>
    <button><a href="{{ route('loginPage' )}}">ログイン</a></button>
@endguest

@auth
    {{-- <span>ようこそ{{ Auth::user()->username }}様</span> --}}
    <span>ようこそ{{ Auth::user()->name_sei }}様</span>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button>ログアウト</button>
    </form>
@endauth
