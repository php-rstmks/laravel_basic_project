<div style="float: right">
    <button><a href="{{route('topPage')}}">トップへ戻る</a></button>
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button>ログアウト</button>
    </form>
</div>
<h2>マイページ</h2>

<p>
    <span>氏名</sp>
    <span>{{Auth::user()->name_sei}}{{Auth::user()->name_mei}}</span>
</p>
<p>
    <span>ニックネーム</sp>
    <span>{{Auth::user()->nickname}}</span>
</p>
<p>
    <span>性別</sp>

    @if (Auth::user()->gender == 1)
        <span>男性</span>
    @else
        <span>女性</span>
    @endif
</p>
<p>
    <span>パスワード</span>
    <span>セキュリティのため非表示</span>
</p>
<p>
    <span>メールアドレス</span>
    <span>{{Auth::user()->email}}</span>
</p>

<button><a href="{{route('withdrawPage')}}">退会</a></button>
