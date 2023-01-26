<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<main>
    <div class="container">
        <h2>会員情報登録フォーム</h2>
        <form method="post" action="{{ route('RegistrationConfirmation') }}">
            @csrf
            <div class="err-msg">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div>
                <span>氏名</span>
                <div>
                    <lavel for="name_sei">姓</lavel>
                    <input type="text" name="name_sei" required value="{{ old('name_sei') }}">
                </div>
                <div>
                    <lavel for="name_mei">名</lavel>
                    <input type="text" name="name_mei" required value="{{ old('name_mei') }}">
                </div>


            <div>
                <label for="">ニックネーム</label>
                <input type="text" name="nickname" value="{{ old('nickname' )}}">
            </div>

            <div>
                <span>性別</span>
                <div>
                    <input type="radio" name="gender" value="1">
                    <label for="">男性</label>
                </div>
                <div>
                    <input type="radio" name="gender" value="2">
                    <label for="">女性</label>
                </div>
            </div>

            <div>
                <label for="">パスワード</label>
                <input type="password" name="password" id="">
            </div>

            <div>
                <label for="">パスワード確認</label>
                <input type="password" name="password_conf" id="">
            </div>

            <div>
                <label for="">メールアドレス</label>
                <input type="text" name="email" id="{{ old('email')}}">
            </div>

            <div>
                <button>確認画面へ</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>
