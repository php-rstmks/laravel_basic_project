    <div class="id">
        <span>ID</span>
        <span>
            {{ $register ? '登録後に自動採番' : $member->id }}
        </span>
    </div>

    <div class="name">
        <span>氏名</span>
        <span>
            {{ $Info['name_sei'] }} {{ $Info['name_mei'] }}
        </span>
    </div>

    <div class="nickname">
        <span>ニックネーム</span>
        <span>
            {{ $Info['nickname'] }}
        </span>
    </div>

    <div class="gender">
        <span>性別</span>
        <span>
            @if ($Info['gender'] == 1)
                <div>男性</div>
            @elseif ($Info['gender'] == 2)
                <div>女性</div>
            @endif

        </span>
    </div>

    <div class="password">
        <span>パスワード</span>
        <span>
        セキュリティのため非表示
        </span>
    </div>

    <div class="email">
        <span>メールアドレス</span>
        <span>
            {{ $Info['email'] }}
        </span>
    </div>

<form mespanod="POST" action="{{ $route }}">
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


