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
            {{ $Info['name_sei'] }} {{ $Info['name_mei'] }}
        </td>
    </tr>

    <tr class="nickname">
        <th>ニックネーム</th>
        <td>
            {{ $Info['nickname'] }}
        </td>
    </tr>

    <tr class="gender">
        <th>性別</th>
        <td>
            @if ($Info['gender'] == 1)
                <div>男性</div>
            @elseif ($Info['gender'] == 2)
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
            {{ $Info['email'] }}
        </td>
    </tr>
</table>

<form method="POST" action="{{ $route }}">
    @csrf
    <input type="hidden" name="name_sei" value="{{ $Info['name_sei'] }}">
    <input type="hidden" name="name_mei" value="{{ $Info['name_mei'] }}">
    <input type="hidden" name="nickname" value="{{ $Info['nickname'] }}">

    <input type="hidden" name="gender" value="{{ $Info['gender'] }}">
    <input type="hidden" name="password" value="{{ $Info['password'] }}">
    <input type="hidden" name="email" value="{{ $Info['email'] }}">
    <button type="submit" class="btn">{{ $register ? '登録完了' : '編集完了' }}</button>
</form>

<button onclick="history.back()">前に戻る</button>


