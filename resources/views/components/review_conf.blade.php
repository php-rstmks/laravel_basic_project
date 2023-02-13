<button onclick="history.back()">前に戻る</button>

<h1>
    @if ($register)
        レビュー登録確認
    @elseif ($edit)
        レビュー編集確認
    @endif
</h1>

@if ($register)
<div>
    <div>
        @if (!is_null($product->image_1))
            <img width=100 src="/storage/{{$product->image_1}}" alt="">
        @endif
    </div>
    <div>
    <span>商品ID {{ $product->id }}</span>
    <span>{{ $product->name }}</span>
    <div>
        <span>総合評価</span>
        @for ($i=1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor
        {{$avg_review}}
    </div>
    </div>
</div>

@elseif ($edit)
    <div>
        <div>
            @if (!is_null($review->product->image_1))
                <img width=100 src="/storage/{{$product->image_1}}" alt="">
            @endif
        </div>
        <div>
        <span>商品ID {{ $review->product->id }}</span>
        <span>{{ $review->product->name }}</span>
        <div>
            <span>総合評価</span>
            @for ($i=1; $i <= $avg_review; $i++)
                <span>★</span>
            @endfor
            {{$avg_review}}
        </div>
        </div>
    </div>
@endif

<hr>

    <div>
        <span>ID</span>
        @if ($register)
            <span>登録後に自動採番</span>
        @elseif($edit)
        <span>{{$Info['id']}}</span>
        @endif
    </div>

    <div>
        <span>商品評価</span>
        {{ $Info['evaluation']}}
    </div>

    <div>
        <span>商品コメント</span>
        {{ $Info['comment'] }}
    </div>

<form method="POST" action="{{ $route }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $review->product->id }}">
    <input type="hidden" name="evaluation" value="{{ $Info['evaluation'] }}">
    <input type="hidden" name="comment" value="{{ $Info['comment'] }}">

    <button type="submit" class="btn">{{ $register ? '登録完了' : '編集完了' }}</button>
</form>

<button onclick="history.back()">前に戻る</button>
