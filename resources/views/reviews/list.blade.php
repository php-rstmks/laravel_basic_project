<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>商品レビュー一覧</h1>

    <button style="float: right"><a href="{{route('topPage')}}">トップに戻る</a></button>

    <div style="display: flex; margin-top: 30px">
        <div>
            @if (!is_null($product->image_1))
            {{-- 商品画像 --}}
            <img width=100 src="/storage/{{$product->image_1}}" alt="">
            @endif
        </div>
        <div>

            <div>{{$product->name}}</div>
            <div>総合評価</div>
        </div>
    </div>

    @foreach ($product->reviews->paginate(5) as $review)
        <div style="display: flex">
            <div>
                {{App\Member::find($review->member_id)->name_sei}}さん
            </div>
            <div>
                @for ($i=1; $i <= $review->evaluation; $i++)
                    <span>★</span>
                @endfor
                {{$review->evaluation}}
            </div>
        </div>

        <p>
            <span>商品コメント</span>
            <span>{{$review->comment}}</span>
        </p>

        <hr>
    @endforeach

    {{$product->reviews->paginate(5)->links('paginate.default')}}


    <button><a href="{{route('productShowPage', $product)}}">詳細ページへ戻る</a></button>
</body>
</html>
