<button style="float: right"><a href="{{route('admin.members.list')}}">一覧に戻る</a></button>
<h2>会員詳細</h2>
    <div>
    <span>ID</span>
    <span>{{ $member->id }}</span>
    </div>

    <div>
    <span>氏名</span>
    <span>{{ $member->name_sei . ' ' . $member->name_mei }}</span>
    </div>

    <div>
    <span>ニックネーム</span>
    <span>{{ $member->nickname }}</span>
    </div>

    <div>
    <span>性別</span>
    @if ($member->gender == 1)
        <span>男性</span>
    @elseif ($member->gender == 2)
        <span>女性</span>
    @endif
    </div>

    <div>
    <span>パスワード</span>
    <span>セキュリティのため非表示</span>
    </div>

    <div>
    <span>メールアドレス</span>
    <span>{{ $member->email }}</span>
    </div>
</d>

<button><a href="{{route('admin.members.editpage', $member)}}">編集</a></button>
<button><a href="{{route('admin.members.delete', $member)}}">削除</a></button>
