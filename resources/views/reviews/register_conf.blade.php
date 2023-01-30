<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>

        @if (!is_null($product->image_1))
        {{-- 商品画像 --}}
            <img width=100 src="/storage/{{$product->image_1}}" alt="">
        @endif


        {{-- <div>{{$product->name}}</div> --}}
        <div>{{$product['name']}}</div>

        {{-- {{App\Review::find($product->product_category_id)->name}}> --}}
    </div>

    <hr>

    <div>商品評価</div>
    {{$evaluation}}

    <div>商品コメント</div>
    {{$comment}}

    <p>{{$product['id']}}</p>

    <form action="{{ route('registerReviewCompPage', $product)}}" method="POST">
        @csrf
        <input type="hidden" name="evaluation" value="{{$evaluation}}" >
        <input type="hidden" name="comment" value="{{$comment}}">
        <input type="hidden" name="product_id" value="{{$product['id']}}">

        <button>登録する</button>
    </form>
    <button onclick="history.back()">前に戻る</button>

</body>
</html>
