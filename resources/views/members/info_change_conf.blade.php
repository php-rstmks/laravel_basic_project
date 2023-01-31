<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>会員情報変更確認画面</h1>

    <p>
        <span>氏名</span>
        <span>{{$changeInfo['name_sei']}}{{$changeInfo['name_mei']}}</span>
    </p>
    <p>
        <span>ニックネーム</span>
        <span>{{$changeInfo['nickname']}}</span>
    </p>

    <p>
        <span>性別</span>
            @if ($changeInfo['gender'] == "1")
                <span>男性</span>
            @else
                <span>女性</span>
            @endif
    </p>

    <form action="{{route('changeMemberInfo')}}" method="POST">
        @csrf
        <input type="hidden" name="name_sei" value="{{$changeInfo['name_sei']}}">
        <input type="hidden" name="name_mei" value="{{$changeInfo['name_mei']}}">
        <input type="hidden" name="gender" value="{{$changeInfo['gender']}}">
        <input type="hidden" name="nickname" value="{{$changeInfo['nickname']}}">
        <button>変更完了</button>
    </form>
    <button onclick="history.back()">前に戻る</button>

</body>
</html>
