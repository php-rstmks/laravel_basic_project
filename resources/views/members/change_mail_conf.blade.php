<h2>メールアドレス変更　認証コード入力</h2>

（＊メールアドレスの変更はまだ完了していません）

変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を入力してください。

<div>認証コード</div>

<form action="{{route('changeEmail')}}" method="POST">
    @csrf
    <input type="text" name="code_from_email" id="">
    <input type="hidden" name="code_original" value="{{$code}}">
    <input type="hidden" name="email" value="{{$email}}">
    <button>認証コードを送信してメールアドレスの変更を完了する</button>
</form>

@if (session('err_msg'))
    {{ session('err_msg') }}
@endif
