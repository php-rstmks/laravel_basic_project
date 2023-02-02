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
            @if (!empty(old('name_sei')))
                <input type="text" name="name_sei" id="" value="{{old('name_sei')}}">
            @elseif (empty(old('name_sei')))
                <input type="text" name="name_sei" id="" value="{{Auth::user()->name_sei}}">
            @endif

            <div>名</div>
            @if (!empty(old('name_sei')))
                <input type="text" name="name_mei" id="" value="{{old('name_mei')}}">
            @elseif (empty(old('name_sei')))
                <input type="text" name="name_mei" id="" value="{{Auth::user()->name_mei}}">
            @endif

        </p>

        @if ($errors->any())

            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif

        <p>
            <span>ニックネーム</span>
            @if (!empty(old('name_sei')))
                <input type="text" name="nickname" id="" value="{{old('nickname')}}">
            @elseif (empty(old('name_sei')))
                <input type="text" name="nickname" id="" value="{{Auth::user()->nickname}}">
            @endif
        </p>

        <p>
            <span>性別</span>
            @if (!empty(old('gender')))
                <input type="radio" name="gender" value="1" {{ old('gender') == "1" ? "checked":"" }}>
            @elseif (empty(old('gender')))
                <input type="radio" name="gender" id="" value="1" {{ Auth::user()->gender == "1" ? "checked":"" }}>
            @endif
            <label for="">男性</label>

            @if (!empty(old('gender')))
                <input type="radio" name="gender" value="2" {{ old('gender') == "2" ? "checked":"" }}>
            @elseif (empty(old('gender')))
                <input type="radio" name="gender" id="" value="2" {{ Auth::user()->gender == "2" ? "checked":"" }}>
            @endif
            <label for="">女性</label>
        </p>
        <button>確認画面へ</button>

    </form>


    <button><a href="{{route('myPage')}}">マイページに戻る</a></button>
</body>
</html>
