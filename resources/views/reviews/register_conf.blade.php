<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button style="float: right"><a href="{{route('topPage')}}">トップに戻る</a></button>
    <div>

        <h1>商品レビュー登録確認</h1>

        @if (!is_null($product->image_1))
        {{-- 商品画像 --}}
            <img width=100 src="/storage/{{$product->image_1}}" alt="">
        @endif


        {{-- <div>{{$product->name}}</div> --}}
        <div>{{$product['name']}}</div>

        {{-- {{App\Review::find($product->product_category_id)->name}}> --}}
    </div>

    <span>総合評価</span>

    @php
        $avg_review = ceil(App\Review::where('product_id', $product->id)->avg('evaluation'));
    @endphp

    <span>
        @for($i = 1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor

        @if ($avg_review >= 1 && $avg_review <= 5)
            <span>{{$avg_review}}</span>
        @endif
    </span>

    <hr>

    <div>商品評価</div>
    {{$evaluation}}

    <div>商品コメント</div>
    {{$comment}}

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
