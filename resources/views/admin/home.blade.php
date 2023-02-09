<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <form style="float: right; display:flex" action="{{route('admin.logout')}}" method="POST">
<p>ようこそ{{Auth::guard('administer')->user()->name}}さん</p>

    @csrf
<button>ログアウト</button></form>

<h2>管理画面メインメニュー</h2>
<button><a href="{{route('admin.members.list')}}">会員一覧</a></button>
<button><a href="{{route('admin.categories.list')}}">カテゴリ一覧</a></button>
<button><a href="{{route('admin.products.list')}}">商品一覧</a></button>
<button><a href="{{route('admin.reviews.list')}}">レビュー一覧</a></button>
</body>
</html>
