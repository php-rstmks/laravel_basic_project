<table class="form">
    <tr class="id">
        <th>ID</th>
        <td>
            {{ $register ? '登録後に自動採番' : $member->id }}
        </td>
    </tr>

    <tr class="name">
        <th>氏名</th>
        <td>
            {{ $newmember['name_sei'] }} {{ $newmember['name_mei'] }}
        </td>
    </tr>

    <tr class="nickname">
        <th>ニックネーム</th>
        <td>
            {{ $newmember['nickname'] }}
        </td>
    </tr>

    <tr class="gender">
        <th>性別</th>
        <td>
            @if ($newmember['gender'] == 1)
                <div>男性</div>
            @elseif ($newmember['gender'] == 2)
                <div>女性</div>
            @endif

        </td>
    </tr>

    <tr class="password">
        <th>パスワード</th>
        <td>
        セキュリティのため非表示
        </td>
    </tr>

    <tr class="email">
        <th>メールアドレス</th>
        <td>
            {{ $newmember['email'] }}
        </td>
    </tr>
</table>

<form method="POST" action="{{ $route }}">
    @csrf
    <input type="hidden" name="name_sei" value="{{ $newmember['name_sei'] }}">
    <input type="hidden" name="name_mei" value="{{ $newmember['name_mei'] }}">
    <input type="hidden" name="nickname" value="{{ $newmember['nickname'] }}">

    <input type="hidden" name="gender" value="{{ $newmember['gender'] }}">
    <input type="hidden" name="password" value="{{ $newmember['password'] }}">
    <input type="hidden" name="email" value="{{ $newmember['email'] }}">
    <button type="submit" class="btn">{{ $register ? '登録完了' : '編集完了' }}</button>
</form>

<button onclick="history.back()">前に戻る</button>


