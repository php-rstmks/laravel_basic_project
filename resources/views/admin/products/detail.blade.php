<button style="float: right"><a href="{{route('admin.products.list')}}">一覧に戻る</a></button>
<h2>商品詳細</h2>
    <div>
    <span>商品ID</span>
    <span>{{ $product->id }}</span>
    </div>

    <div>
    <span>名前</span>
    <span>{{ $product->name }}</span>
    </div>

    <span>商品カテゴリ</span>
                   {{-- カテゴリ＞サブカテゴリ --}}
    <div>
        {{App\Product_category::find($product->product_category_id)->name}}
        ＞
        {{App\Product_subcategory::find($product->product_subcategory_id)->name}}
    </div>

    <div>
    <span>性別</span>
    @if ($product->gender == 1)
        <span>男性</span>
    @elseif ($product->gender == 2)
        <span>女性</span>
    @endif
    </div>

    <div>
    <span>パスワード</span>
    <span>セキュリティのため非表示</span>
    </div>

    <div>
    <span>メールアドレス</span>
    <span>{{ $product->email }}</span>
    </div>

<button><a href="{{route('admin.products.editpage', $product)}}">編集</a></button>
<button><a href="{{route('admin.products.delete', $product)}}">削除</a></button>
