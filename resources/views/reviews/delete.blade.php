<h1>商品レビュー削除確認</h1>
<div>
    <div>{{$review->product->name}}</div>
    <div>総合評価</div>
    @for ($i = 1; $i <= $avg_review; $i++)
        <span>★</span>
    @endfor

    @php
        unset($review->product)
    @endphp
    <hr>
    <div>商品評価</div>



    <button><a href="{{route('deleteReview', $review)}}">レビューを削除する</a></button>
    <button onclick="history.back()">前に戻る</button>
    
</div>
