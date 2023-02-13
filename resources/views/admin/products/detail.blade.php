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

    <h4>商品写真</h4>

    <div>

        @if (!is_null($product->image_1))
            <div>写真1</div>
            <div>
                <img width="170" src="/storage/{{$product->image_1}}" alt="">
            </div>
        @endif

        @if (!is_null($product->image_2))
            <div>写真2</div>
            <div>
                <img width="170" src="/storage/{{$product->image_2}}" alt="">
            </div>
        @endif

        @if (!is_null($product->image_3))
            <div>写真3</div>
            <div>
                <img width="170" src="/storage/{{$product->image_3}}" alt="">
            </div>
        @endif

        @if (!is_null($product->image_4))
            <div>写真4</div>
            <div>
                <img width="170" src="/storage/{{$product->image_4}}" alt="">
            </div>
        @endif

    </div>

    <div>
    <span>商品説明</span>
    <span>{{ $product->product_content }}</span>
    </div>

    <div style="background-color:gray;">
        <span>総合評価</span>
        @for ($i=1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor
        <span>
            {{$avg_review}}
        </span>
    </div>

    <br>

    @if ($avg_review == 0)
        <p>レビューはありません</p>
    @else

        @foreach($reviews as $review)
            <div>
                <div>
                    <span>商品レビューID</span>
                    <span>{{$review->id}}</span>
                </div>

                <a href="{{route('admin.members.detailpage', App\Member::find($review->member_id))}}">{{App\Member::find($review->member_id)->name_sei}}{{App\Member::find($review->member_id)->name_mei}}さん</a>

                @for ($i=1; $i <= $review->evaluation; $i++)
                    <span>★</span>
                @endfor
                {{$review->evaluation}}
                <div>
                    <span>商品コメント</span>
                    <span>

                        {{$review->comment}}
                    </span>
                </div>
            </div>

            <hr>
        @endforeach

        {{ $reviews->links('paginate.default') }}
    @endif


<button><a href="{{route('admin.products.editpage', $product)}}">編集</a></button>
<button><a href="{{route('admin.products.delete', $product)}}">削除</a></button>
