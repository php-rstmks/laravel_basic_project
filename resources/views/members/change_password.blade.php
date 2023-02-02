<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>パスワード変更</h2>

<form action="{{route('changeMemberPassword')}}" method="POST">
    @csrf
    <label for="">パスワード</label>
    <input type="password" name="password" id="">
    <label for="">パスワード確認</label>
    <input type="password" name="password_conf" id="">
    <button>パスワードを変更</button>
</form>

@if ($errors->any())

@foreach($errors->all() as $error)
    <div style="color: red">{{ $error }}</div>
@endforeach
@endif

<button><a href="{{route('myPage')}}">マイページに戻る</a></button>




</body>
</html>
