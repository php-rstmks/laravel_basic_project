
@php
$email = Session::get('send_email');
Session::forget('send_email');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>現在のメールアドレス</p>
    <p>{{Auth::user()->email}}</p>

    <p>変更後のメールアドレス</p>
    <form action="{{route('changeEmailCodePage')}}" method="POST">
        @csrf
        <input type="email" name="email" value="{{$email}}">
        <button>認証メール送信</button>
    </form>

    @if ($errors->any())

    @foreach($errors->all() as $error)
        <div style="color: red">{{ $error }}</div>
    @endforeach
    @endif

    <button><a href="{{route('myPage')}}">マイページに戻る</a></button>

</body>
</html>
