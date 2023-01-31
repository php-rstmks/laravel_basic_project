<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>会員情報登録</h1>

    <form action="{{route('changeMemberInfoConfPage')}}" method="POST">
        @csrf

        <p>
            <span>氏名</span>
            <div>姓</div>
            <input type="text" name="name_sei" id="" value="{{old('name_sei')}}">
            <div>名</div>
            <input type="text" name="name_mei" value="{{old('name_mei')}}">

        </p>

        @if ($errors->any())

            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif

        <p>
            <span>ニックネーム</span>
            <input type="text" name="nickname" value="{{old('nickname')}}">
        </p>

        <p>
            <span>性別</span>

            <input type="radio" name="gender" value="1" {{ old('gender') == "1" ? "checked":"" }}>
            <label for="">男性</label>
            <input type="radio" name="gender" value="2" {{ old('gender') == "2" ? "checked":"" }}>
            <label for="">女性</label>
        </p>
        <button>確認画面へ</button>

    </form>


    <button><a href="{{route('myPage')}}">マイページに戻る</a></button>
</body>
</html>
