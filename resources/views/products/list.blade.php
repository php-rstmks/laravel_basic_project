<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<button><a href="{{route('registerProductPage')}}">新規商品登録</a></button>
<div>商品一覧</div>

<form action="{{route('productListPage')}}" method="GET">
    {{-- @csrf --}}
    <span>カテゴリ</span>

    {{-- カテゴリ --}}
    <select name="product_category_id" id="js-ajax-change-subcategories">
        <option value="">カテゴリ</option>
        @foreach($product_categories as $product_category)
            @if(!empty($return_product_caegory_id))
                <option value="{{ $product_category->id }}" {{ ( $return_product_caegory_id == $product_category->id) ? 'selected': '' }}>{{ $product_category->name }}</option>
            @else
                <option value="{{ $product_category->id }}">{{ $product_category->name }}</option>
            @endif
        @endforeach
    </select>

    <div>
        <select name="product_subcategory_id" id="js-ajax-target-field">
            {{-- <option value="0">サブカテゴリ</option> --}}
            <option value="">サブカテゴリ</option>
            @if(!empty($return_product_subcaegory_id))
                @foreach($product_subcategories as $product_subcategory)
                        <option value="{{ $product_subcategory->id }}" {{ ( $return_product_subcaegory_id == $product_subcategory->id) ? 'selected': '' }}>{{ $product_subcategory->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <span>フリーワード</span>
        <input style="width: 260px;" type="text" name="free_word">
    </div>

    <button>商品検索</button>


</form>

{{--　検索した商品を表示する部分 --}}

<div>
    @if (!empty($products))
        @foreach ($products as $product)

            <div style="display: flex">

                @if (!is_null($product->image_1))
                {{-- 商品画像 --}}
                    <img width=100 src="/storage/{{$product->image_1}}" alt="">
                @endif

                <div>
                    <div>
                        {{App\Product_category::find($product->product_category_id)->name}}>
                        {{App\Product_subcategory::find($product->product_subcategory_id)->name}}
                    </div>

                    <a href="{{route('productShowPage', $product)}}">{{$product->name}}</a>
                </div>
            </div>
            <button><a href="{{route('productShowPage', $product)}}">詳細</a></button>
            <hr>
        @endforeach
    @endif
</div>

{{-- ページネーション --}}
@if (!$return_state)
    <div class="pagination">
        {{ $products->links('paginate.default') }}
    </div>

@else
    {{ $products->appends(request()->query())->links('paginate.default') }}
@endif

<button><a href="{{route('topPage')}}">トップに戻る</a></button>

<script>
    $(function() {
    // 大カテゴリが選択されたら、そのIDから小カテゴリを取ってくる
        $('#js-ajax-change-subcategories').change(function() {
            $('#js-ajax-target-field').empty();
            let categoryid = $(this).val();
            console.log(categoryid);
            $.ajax({
                url: '/set-subcategory/'+categoryid,
                type: 'GET',
                // コントローラから受け取ったデータ(検索結果)をdataに代入
            }).done((data) => {
                console.log(data.product_subcategories);
                $('#js-ajax-target-field').append('<option value="">サブカテゴリ</option>')
                $(data.product_subcategories).each((index, category) => {
                    console.log(category)
                    $('#js-ajax-target-field').append('<option value='+category.id+'>'+category.name+'</option>')
                });
            })
        })
    })
</script>
