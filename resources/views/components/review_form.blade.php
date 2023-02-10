<button style="float: right"><a href="{{route('admin.reviews.list')}}">一覧に戻る</a></button>

<h1>
    @if ($register)
        レビュー登録
    @elseif ($edit)
        レビュー編集
    @endif
</h1>

<hr>

<form method="POST" action="{{ $route }}">
    @csrf

    @if ($errors->any())

        @foreach($errors->all() as $error)
            <div style="color: red">{{ $error }}</div>
        @endforeach
    @endif

    <div>
        <span>商品</span>

        @if ($register)
            <select name="product_id">
                @foreach (App\Product::all() as $product)
                    <option class="ase" value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>

        @elseif ($edit)
            {{App\Product::find($review->product_id)->name}}
        @endif
    </div>

    <div>
        <span>ID</span>
        <span>
        {{ $register ? '登録後に自動採番' : $review->id }}
        @if ($edit)
            <input type="hidden" name="id" value="{{ $review->id }}">
        @endif
        </span>
    </div>

    <div>
        <span>商品評価</span>

        <select name="evaluation">
            @if ($register)
                <option value="5" {{ old('evaluation') == '5'? 'selected':'' }}>5</option>
                <option value="4" {{ old('evaluation') == '4'? 'selected':'' }}>4</option>
                <option value="3" {{ old('evaluation') == '3'? 'selected':'' }}>3</option>
                <option value="2" {{ old('evaluation') == '2'? 'selected':'' }}>2</option>
                <option value="1" {{ old('evaluation') == '1'? 'selected':'' }}>1</option>
            @elseif ($edit)
                <option value="5" {{ old('evaluation', $review->evaluation) == '5'? 'selected':'' }}>5</option>
                <option value="4" {{ old('evaluation', $review->evaluation) == '4'? 'selected':'' }}>4</option>
                <option value="3" {{ old('evaluation', $review->evaluation) == '3'? 'selected':'' }}>3</option>
                <option value="2" {{ old('evaluation', $review->evaluation) == '2'? 'selected':'' }}>2</option>
                <option value="1" {{ old('evaluation', $review->evaluation) == '1'? 'selected':'' }}>1</option>
            @endif
        </select>
    </div>

    <div>
        <span>商品コメント</span>
        <input type="text" name="comment" value="{{ $register ? old('comment') : old('comment', $review->comment) }}">
    </div>


    <button type="submit" class="btn">確認画面へ</button>
</form>
