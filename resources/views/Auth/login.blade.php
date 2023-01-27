<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>ログイン</div>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <span>メールアドレス（ID）</span>
            <input type="email" name="email" id="" value="{{ old('email') }}">
        </div>

        <div>
            <span>パスワード</span>
            <input type="password" name="password" id="">
        </div>

        <a href="">パスワードを忘れた方はこちら</a>

        <button>ログイン</button>

        <button><a href="{{ route('topPage') }}">トップに戻る</a></button>

    </form>


</body>
</html>
