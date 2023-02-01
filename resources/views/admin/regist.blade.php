<form method="POST" action="{{ route('adminCreate') }}">
    @csrf
    <input type="text" name="name" id="">

<div>ログインID</div>
            <input id="text" type="text" name="login_id" value="{{ old('email') }}">

        <label for=""> パスワード</label>
        <input type="password" name="password" id="">
        <button>送信</button>

</form>
