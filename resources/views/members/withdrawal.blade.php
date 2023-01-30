<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button><a href="{{route('topPage')}}">トップに戻る</a></button>

    <form action="{{route('logout')}}">
        <button>ログアウト</button>
    </form>

    <p>退会します。よろしいですか</p>

    <button><a href="{{route('myPage')}}">マイページに戻る</a></button>

    <form action="{{route('withdrawal')}}" method="POST">
        @csrf
        <button>退会する</button>
    </form>

</body>
</html>
