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

    <div>
        <span>商品説明</span>
        <span>{{$product->product_content}}</span>
        </div>

    <div>
        <button class="btn btn-back-blue" type="button" onclick="history.back()">商品一覧に戻る</button>
    </div>
</body>
</html>
