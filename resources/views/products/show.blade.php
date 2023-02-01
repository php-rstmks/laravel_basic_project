<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button><a href="{{route('topPage')}}">トップに戻る</a></button>
    <h1>商品詳細</h1>
    <div>
        {{App\Product_category::find($product->product_category_id)->name}}>
        {{App\Product_subcategory::find($product->product_subcategory_id)->name}}
    </div>
    <span>{{$product->name}}</span>
    <span>更新日時：{{$product->updated_at}}</span>


    <div>

    @if (!is_null($product->image_1))
    {{-- 商品画像 --}}
        <img width=100 src="/storage/{{$product->image_1}}" alt="">
    @endif

    @if (!is_null($product->image_2))
    {{-- 商品画像 --}}
        <img width=100 src="/storage/{{$product->image_2}}" alt="">
    @endif
    @if (!is_null($product->image_3))
    {{-- 商品画像 --}}
        <img width=100 src="/storage/{{$product->image_3}}" alt="">
    @endif
    @if (!is_null($product->image_4))
    {{-- 商品画像 --}}
        <img width=100 src="/storage/{{$product->image_4}}" alt="">
    @endif
    </div>


    <div>
        <span>商品説明</span>
        <p>{{$product->product_content}}</p>
    </div>

    <p>
        <div>■商品レビュー</div>
        <span>総合評価</span>
        @for ($i=1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor
        {{$avg_review}}

    </p>

    <a href="{{route('reviewListPage', $product)}}">＞＞レビューを見る</a>

    <p>
    @auth
        <button><a href="{{route('registerReviewPage', $product)}}">この商品についてのレビューを登録</a></button>
    @endauth
    </p>

    <div>
        <button><a href="{{route('productListPage')}}">商品一覧に戻る</a></button>
    </div>
</body>
</html>
