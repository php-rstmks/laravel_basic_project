<h2>メールアドレス変更　認証コード入力</h2>

（＊メールアドレスの変更はまだ完了していません）

変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を入力してください。

<div>認証コード</div>

<form action="{{route('changeEmail')}}" method="POST">
    @csrf
    <input type="text" name="code_from_email" id="">
    {{-- <input type="hidden" name="code_original" value="{{$code}}"> --}}
    <input type="hidden" name="email" value="{{$email}}">
    <button>認証コードを送信してメールアドレスの変更を完了する</button>
</form>

{{-- 認証コードの部分でバリデーションに引っかかったとき --}}
@if (Session::has('err_msg'))
    <div style="color: red">{{Session::pull('err_msg', 'default')}}</div>
@endif

