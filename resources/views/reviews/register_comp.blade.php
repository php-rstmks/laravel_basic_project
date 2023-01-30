<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>商品の登録レビューが完了しました</div>
    <button><a href="{{route('')}}">商品レビュー一覧へ</a></button>
    <button><a href="{{route('productShowPage', $product)}}">商品詳細に戻る</a></button>
</body>
</html>
