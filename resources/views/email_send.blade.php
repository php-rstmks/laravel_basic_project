<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>パスワード再設定用の URL を記載したメールを送信します。</div>
    <div>ご登録されたメールアドレスを入力してください。</div>

    <form action="{{ route('sendEmail') }}" method="POST">
        @csrf
        <input type="email" name="email" id="">
        <button>送信する</button>
    </form>

    @if ($errors->any())
        <div style="color: red">{{ $errors->first() }}</div>
    @endif

</body>
</html>
