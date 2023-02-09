<button style="float: right"><a href="{{route('admin.members.list')}}">一覧に戻る</a></button>

<h1>
    @if ($register)
        会員登録
    @elseif ($edit)
        会員編集
    @endif
</h1>
<form method="POST" action="{{ $route }}">
    @csrf
    <table>
        @if ($errors->any())

            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif
        <tr>
            <th>ID</th>
            <td>
            {{ $register ? '登録後に自動採番' : $member->id }}
            @if ($edit)
                <input type="hidden" name="id" value="{{ $member->id }}">
            @endif
            </td>
        </tr>

        <tr class="name">
            <th>氏名</th>
            <td>
                姓
                <input id="name_sei" type="text" name="name_sei" value="{{ $register ? old('name_sei') : old('name_sei', $member->name_sei) }}">
            </label>
                名
                <input id="name_mei" type="text" name="name_mei" value="{{ $register ? old('name_mei') : old('name_mei', $member->name_mei) }}">
            </label>
            </td>
        </tr>

        <tr class="nickname">
            <th>ニックネーム</th>
            <td><input type="text" name="nickname" value="{{ $register ? old('nickname') : old('nickname', $member->nickname) }}"></td>
        </tr>

        <tr class="gender">
            <th>性別</th>
            <td>
            @if ($register)
                <input id="man" type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>
                男性
                <input id="woman" type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>
                女性
            @else
                <input id="man" type="radio" name="gender" value="1" {{ old('gender', $member->gender) == 1 ? 'checked' : '' }}>
                男性
                <input id="woman" type="radio" name="gender" value="2" {{ old('gender', $member->gender) == 2 ? 'checked' : '' }}>
                女性
            @endif
            </td>
        </tr>
        <tr class="password">
            <th>パスワード</th>
            <td><input type="password" name="password"></td>
        </tr>

        <tr class="password-confirmation">
            <th>パスワード確認</th>
            <td><input type="password" name="password_conf"></td>
        </tr>

        <tr>
            <th>メールアドレス</th>
            <td><input type="email" name="email" value="{{ $register ? old('email') : old('email', $member->email) }}"></td>
        </tr>
    </table>

    <button type="submit" class="btn">確認画面へ</button>
</form>
