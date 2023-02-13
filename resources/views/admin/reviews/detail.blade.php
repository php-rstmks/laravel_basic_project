<button style="float: right"><a href="{{route('admin.reviews.list')}}">一覧に戻る</a></button>

<h2>商品レビュー詳細</h2>

<div>
    <div>
        @if (!is_null($review->product->image_1))
            <img width=100 src="/storage/{{$review->product->image_1}}" alt="">
        @endif
    </div>
    <div>
    <span>商品ID {{ $review->product->id }}</span>
    <p>{{ $review->product->name }}</p>
    <div>
        <span>総合評価</span>
        @for ($i=1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor
        {{$avg_review}}
    </div>
    </div>
</div>

<hr>

    <div>
        <span>ID</span>
        <span>{{ $review->id }}</span>
    </div>

    <div>
    <span>商品評価</span>
    <span>{{ $review->evaluation }}</span>
    </div>

    <div>
        <span>商品コメント</span>
        <span>{{ $review->comment}}</span>
    </div>

</div>

<button><a href="{{route('admin.reviews.editpage', $review)}}">編集</a></button>
<button><a href="{{route('admin.reviews.delete', $review)}}">削除</a></button>
