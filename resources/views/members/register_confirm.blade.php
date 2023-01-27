<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h2>会員登録確認画面</h2>

        <span>氏名</span>
        <span>{{ $registerMember['name_sei'] }}{{ $registerMember['name_mei'] }}</span>


        <div>ニックネーム</div>
        <span>{{ $registerMember['nickname'] }}</span>

        <div>
            <span>性別</span>
            <span>{{ $gender }}</span>
                {{-- @if ($registerMember['gender'] == "1")
                    <span>男性</span>
                @else
                    <span>女性</span>

                @endif --}}
        </div>

        <div>
            <span>パスワード</span>
            <span>セキュリティのため非表示</span>
        </div>

        <div>
            <span>メールアドレス</span>
            <span>{{ $registerMember['email']}}</span>
        </div>

    <form action="{{ route('registerComp') }}" method="POST">
        @csrf
        <input type="hidden" name="name_sei" value="{{ $registerMember['name_sei'] }}">
        <input type="hidden" name="name_mei" value="{{ $registerMember['name_mei'] }}">
        <input type="hidden" name="gender" value="{{ $registerMember['gender'] }}">
        <input type="hidden" name="password" value="{{ $registerMember['password'] }}">
        <input type="hidden" name="nickname" value="{{ $registerMember['nickname'] }}">
        <input type="hidden" name="email" value="{{ $registerMember['email'] }}">
        <button>登録完了</button>
    </form>
    <button onclick="history.back()">前に戻る</button>

</body>
</html>
