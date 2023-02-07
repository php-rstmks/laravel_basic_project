
<div>
    <h2>管理画面</h2>
    <div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <span>ログインID</span>
                {{-- @if(!empty($login_id))
                    <input style="width: 260px;" type="text" name="login_id" value="{{ $login_id }}">
                @else --}}
                <input style="width: 260px;" type="text" name="login_id" value="{{ old('login_id') }}">
                {{-- @endif --}}
            </div>
            <div>
                <span>パスワード</span>
                <input type="password" name="password">
            </div>


                @if ($errors->any())

                    @foreach($errors->all() as $error)
                        <div style="color: red">{{ $error }}</div>
                    @endforeach
                @endif

            <button>ログイン</button>
        </form>
    </div>
</div>
