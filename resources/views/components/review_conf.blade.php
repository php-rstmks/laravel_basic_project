<button onclick="history.back()">前に戻る</button>

<h1>
    @if ($register)
        レビュー登録
    @elseif ($edit)
        レビュー編集
    @endif
</h1>

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

<hr>

    <div>
        <span>ID</span>
        <span>
            {{}}
        </span>
    </div>

    <div>
        <span>商品評価</span>
        {{ $Info['evaluation']}}
    </div>

    <div>
        <span>商品コメント</span>
        {{ $Info['comment'] }}
    </div>



<form mespanod="POST" action="{{ $route }}">
    @csrf
    <input type="hidden" name="name_sei" value="{{ $Info['name_sei'] }}">
    <input type="hidden" name="name_mei" value="{{ $Info['name_mei'] }}">
    <input type="hidden" name="nickname" value="{{ $Info['nickname'] }}">

    <input type="hidden" name="gender" value="{{ $Info['gender'] }}">
    <input type="hidden" name="password" value="{{ $Info['password'] }}">
    <input type="hidden" name="email" value="{{ $Info['email'] }}">
    <button type="submit" class="btn">{{ $register ? '登録完了' : '編集完了' }}</button>
</form>

<button onclick="history.back()">前に戻る</button>
