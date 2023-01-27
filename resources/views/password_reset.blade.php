<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('passwordReset')}}" method="POST">
        @csrf
        <div>
            <span>パスワード</span>
            <input type="password" name="password" id="">
        </div>
        <div>
            <span>パスワード確認</span>
            <input type="password" name="password_conf" id="">
        </div>
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </ul>
            </div>
        @endif
        <button>パスワードリセット</button>
        <button><a href="{{route('topPage')}}">トップに戻る</a></button>
    </form>
</body>
</html>
