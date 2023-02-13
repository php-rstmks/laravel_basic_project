<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>
        @if ($register)
            商品登録
        @elseif ($edit)
            商品編集
        @endif
    </h1>

    <div>
        <span>商品名</span>
        <span>{{$Info['product_name']}}</span>
    </div>

    <div>
        <span>商品カテゴリ</span>
        <span>{{ App\Product_category::find($Info['product_category_id'])->name}}＞</span>
        <span>{{ App\Product_subcategory::find($Info['product_subcategory_id'])->name}}
    </div>

    <div>
        <span>商品写真</span>

            @if (!is_null($Info['image_1']))
                <div>写真1</div>
                <div>
                    <img width="170" src="/storage/{{$Info['image_1']}}" alt="">
                </div>
            @endif

            @if (!is_null($Info['image_2']))
            <div>写真2</div>

                <div>
                    <img width="170" src="/storage/{{$Info['image_2']}}" alt="">
                </div>
            @endif

            @if (!is_null($Info['image_3']))
            <div>写真3</div>

                <div>
                    <img width="170" src="/storage/{{$Info['image_3']}}" alt="">
                </div>
            @endif

            @if (!is_null($Info['image_4']))
            <div>写真4</div>

                <div>
                    <img width="170" src="/storage/{{$Info['image_4']}}" alt="">
                </div>
            @endif
    </div>

    <div>
        <span>商品説明</span>
        <span>{{$Info['product_content']}}</span>
    </div>

    <form action="{{ $route }}" method="POST">
        @csrf
        <input type="hidden" name="product_name" value="<?= $Info['product_name']; ?>">
        <input type="hidden" name="product_category_id" value="{{ $Info['product_category_id'] }}">
        <input type="hidden" name="product_subcategory_id" value="{{ $Info['product_subcategory_id'] }}">
        <input type="hidden" name="product_content" value="{{ $Info['product_content'] }}">
        <input type="hidden" name="image_1" value="{{ $Info['image_1'] }}">
        <input type="hidden" name="image_2" value="{{ $Info['image_2'] }}">
        <input type="hidden" name="image_3" value="{{ $Info['image_3'] }}">
        <input type="hidden" name="image_4" value="{{ $Info['image_4'] }}">
        <button>登録する</button>
    </form>
    <button onclick="history.back()">前に戻る</button>

</body>
</html>
