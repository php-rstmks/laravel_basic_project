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
        <form method="post" action="{{ route('registerConf') }}">
            @csrf
            <div>
                <span>氏名</span>
                <div>
                    <label for="name_sei">姓</label>
                    <input type="text" name="name_sei" value="{{ old('name_sei') }}">
                </div>
                <div>
                    <label for="name_mei">名</label>
                    <input type="text" name="name_mei" value="{{ old('name_mei') }}">
                </div>
            </div>

            @if ($errors->any())

                @foreach($errors->all() as $error)
                    <div style="color: red">{{ $error }}</div>
                @endforeach
            @endif

            <div>
                <label for="">ニックネーム</label>
                <input type="text" name="nickname" value="{{ old('nickname' )}}">
            </div>

            <div>
                <span>性別</span>
                <div>
                    <input type="radio" name="gender" value="1" <?php if (old('gender') == 1) { echo "checked"; }?>>
                    <label for="">男性</label>
                </div>
                <div>
                    <input type="radio" name="gender" value="2" <?php if (old('gender') == 2) { echo "checked"; }?>>
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
                <input type="email" name="email" value="{{ old('email')}}">
            </div>

            <div>
                <button>確認画面へ</button>
            </div>

            <div>
                <button><a href="{{ route('topPage')}}">トップへ戻る</a></button>
            </div>
        </form>
    </div>
</main>
</body>
</html>
