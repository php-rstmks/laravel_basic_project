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
    <h1>商品レビュー管理</h1>

    @foreach(Auth::user()->reviews->paginate(6) as $review)
    {{-- @foreach(App\Review::find(Auth::id())->get() as $review) --}}
        <hr>
        <div style="display: flex">

            <div>
                <img width=100 src="/storage/{{$review->product->image_1}}" alt="">
            </div>

            <div>
                <div style="border: 1px black solid">
                    <span>{{App\Product_category::find($review->product->product_category_id)->name}}></span>
                    <span>{{App\Product_subcategory::find($review->product->product_subcategory_id)->name}}</span>
                </div>
                <div>{{$review->product->name}}</div>
                @for ($i = 1; $i <= $review->evaluation; $i++)
                    <span>★</span>
                @endfor
                {{$review->evaluation}}
                @if(mb_strlen($review->comment) >= 16)
                    {{ mb_substr($review->comment,0,16) }}...
                @else
                    {{ $review->comment }}
                @endif
            </div>

            @php
                unset($review->product);
            @endphp
        </div>
        <button><a href="{{route('reviewEditPage', $review)}}">レビュー編集</a></button>
        <button><a href="{{route('reviewDeletePage', $review)}}">レビュー削除</a></button>
    @endforeach
    {{Auth::user()->reviews->paginate(5)->links('paginate.default')}}

    <button><a href="{{route('myPage')}}">マイページに戻る</a></button>

</body>
</html>
