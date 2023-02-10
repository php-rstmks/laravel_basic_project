<button style="float: right"><a href="{{route('admin.categories.list')}}">一覧に戻る</a></button>
<h2>会員詳細</h2>
    <div>
    <span>商品大カテゴリID</span>
    <span>{{ $category->id }}</span>
    </div>

    <div>
        <span>商品大カテゴリ</span>
        <span>{{ $category->name }}</span>
    </div>

    <div>
        <span>商品小カテゴリ</span>
        @foreach ($subcategories_linked_with_category as $subcategory)
            <p>{{$subcategory->name}}</p>
        @endforeach
    </div>
</d>

<button><a href="{{route('admin.categories.editpage', $category)}}">編集</a></button>
<button><a href="{{route('admin.categories.delete', $category)}}">削除</a></button>
