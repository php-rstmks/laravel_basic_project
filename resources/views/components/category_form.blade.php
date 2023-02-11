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
        {{ $register ? '登録後に自動採番' : $category->id }}
        @if ($edit)
            <input type="hidden" name="id" value="{{ $category->id }}">
        @endif
        </span>
    </div>

    <div>
        <span>商品大カテゴリ</span>
        <span>

            <input type="text" name="category_name" value="{{ $register ? old('category_name') : old('category_name', $category->name)}}">
        </span>
    </div>

    <div>

        <div>商品小カテゴリ</div>

        <div>
            @for($i = 0; $i < 10; $i++)
                <p>

                    @if (!$register && !empty($subcategories[$i]))
                        <input type="text" name="subcategory_name[]" value="{{ $register ? old("subcategory_name.$i") : old("subcategory_name.$i", $subcategories[$i]->name) }}">
                    @else
                        <input type="text" name="subcategory_name[]" value="{{ $register ? old("subcategory_name.$i") : old("subcategory_name.$i") }}">

                    @endif
                </p>

            @endfor
        </div>
    </div>


    <button type="submit" class="btn">確認画面へ</button>
</form>
