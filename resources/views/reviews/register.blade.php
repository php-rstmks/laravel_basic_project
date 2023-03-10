<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button style="float: right"><a href="{{route('topPage')}}">トップへ戻る</a></button>
    <div>商品レビュー登録</div>

    <div>

        @if (!is_null($product->image_1))
        {{-- 商品画像 --}}
            <img width=100 src="/storage/{{$product->image_1}}" alt="">
        @endif


        <div>{{$product->name}}</div>

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

        {{-- {{App\Review::find($product->product_category_id)->name}}> --}}


    </div>

    <hr>

    <form action="{{route('registerReviewConfPage', $product)}}" method="POST">
        @csrf
        <div style="display: flex;">
            <div>商品評価</div>
            <select name="evaluation">
                <option value="5" {{ old('evaluation') == '5'? 'selected':'' }}>5</option>
                <option value="4" {{ old('evaluation') == '4'? 'selected':'' }}>4</option>
                <option value="3" {{ old('evaluation') == '3'? 'selected':'' }}>3</option>
                <option value="2" {{ old('evaluation') == '2'? 'selected':'' }}>2</option>
                <option value="1" {{ old('evaluation') == '1'? 'selected':'' }}>1</option>
            </select>
        </div>

        <div class="form-group" style="display: flex;">
            <div>商品コメント</div>
            <div>
                <input type="text" name="comment" value="{{old('comment')}}">
            </div>
        </div>

        @if ($errors->any())

            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif

        <button>商品レビュー登録確認</button>
    </form>

    <button onclick="history.back()">商品詳細に戻る</button>
</body>
</html>
