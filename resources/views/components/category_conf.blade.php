<button style="float: right"><a href="{{route('admin.categories.list')}}">一覧に戻る</a></button>

<h1>
    @if ($register)
        カテゴリ登録確認
    @elseif ($edit)
        カテゴリ編集確認
    @endif
</h1>

    <div>
        <span>商品大カテゴリID</span>
        @if ($register)
            <span>登録後に自動採番</span>

        @elseif($edit)

            <span>{{$Info['id']}}</span>
        @endif
    </div>

    <div>
        <span>商品大カテゴリ</span>
        {{ $Info['category_name']}}
    </div>

    <div>
        <span>商品小カテゴリ</span>
        @foreach ($Info['subcategory_name'] as $subcategory_name)
            <p>{{ $subcategory_name }}</p>
        @endforeach
    </div>

<form method="POST" action="{{ $route }}">
    @csrf
    <input type="hidden" name="category_name" value="{{ $Info['category_name'] }}">

    {{-- サブカテゴリ送信部分 --}}
    @foreach ($Info['subcategory_name'] as $subcategory_name)
        <input type="hidden" name="subcategory_name[]" value="{{$subcategory_name}}">
    @endforeach

    <button type="submit" class="btn">{{ $register ? '登録完了' : '編集完了' }}</button>
</form>

<button onclick="history.back()">前に戻る</button>

