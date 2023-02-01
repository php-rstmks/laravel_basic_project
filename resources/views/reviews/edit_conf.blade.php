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
    <h1>商品レビュー編集確認</h1>

    <div>
        <div style="border: 1px black solid">
            <span>{{App\Product_category::find($review->product->product_category_id)->name}}></span>
            <span>{{App\Product_subcategory::find($review->product->product_subcategory_id)->name}}</span>
        </div>
        <div>{{$review->product->name}}</div>
        <div>総合評価</div>
        @for ($i = 1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor
        {{$review->evaluation}}
    </div>

    <hr>

    <div>
        <span>商品評価</span>
        {{$evaluation}}
        <div>商品コメント</div>
        <div>
            {{$comment}}
        </div>
    </div>
    <form action="{{route('editReview', $review)}}" method="POST">
        @csrf
        <input type="hidden" name="evaluation" value="{{$evaluation}}"">
        <input type="hidden" name="comment" value="{{$comment}}"">
        <button>更新する</button>
    </form>
    <button onclick="history.back()">前に戻る</button>


</body>
</html>
