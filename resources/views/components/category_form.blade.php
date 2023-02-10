<button style="float: right"><a href="{{route('admin.categories.list')}}">一覧に戻る</a></button>

<h1>
    @if ($register)
        商品カテゴリー登録
    @elseif ($edit)
        商品カテゴリー編集
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
        <span>商品大カテゴリID</span>
        <span>
        {{ $register ? '登録後に自動採番' : $review->id }}
        @if ($edit)
            <input type="hidden" name="id" value="{{ $review->id }}">
        @endif
        </span>
    </div>

    <div>
        <span>商品大カテゴリ</span>
        <span>

            <input type="text" name="category_name">
        </span>
    </div>

    <div style="display: flex">

        <div>商品小カテゴリ</div>
        <div>

            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>
            <div>
                <input type="text" name="subcategory_name">
            </div>

        </div>
    </div>


    <button type="submit" class="btn">確認画面へ</button>
</form>
