<?php

use Illuminate\Support\Facades\Session;

$email = Session::get('login_email');
Session::forget('login_email');

?>


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
        {{-- ↓表示されない。なぜ --}}
        @if (session('login_err'))
            {{ session('login_err') }}
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <span>メールアドレス（ID）</span>
            {{-- <input type="email" name="email" id="" value="{{ old('email') }}"> --}}
            <input type="email" name="email" id="" value="<?= $email; ?>">
        </div>

        <div>
            <span>パスワード</span>
            <input type="password" name="password" id="">
        </div>

        <a href="{{ route('sendEmailPage')}}">パスワードを忘れた方はこちら</a>

        <button>ログイン</button>

        <button><a href="{{ route('topPage') }}">トップに戻る</a></button>

    </form>


</body>
</html>
