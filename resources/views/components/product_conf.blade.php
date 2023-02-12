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
        <span>{{$product['product_name']}}</span>
    </div>

    <div>
        <span>商品カテゴリ</span>
        <span>{{ $category['name']}}>{{ $sub_category['name']}}</span>
    </div>

    <div>
        <span>商品写真</span>

        {{-- @for ($i=1; $i <= 4; $i++)
        @php
            $path = $product['image_1']
        @endphp --}}



            @if (!is_null($product['image_1']))
                <div>写真1</div>
                <div>
                    <img width="170" src="/storage/{{$product['image_1']}}" alt="">
                </div>
            @endif

            @if (!is_null($product['image_2']))
            <div>写真2</div>

                <div>
                    <img width="170" src="/storage/{{$product['image_2']}}" alt="">
                </div>
            @endif

            @if (!is_null($product['image_3']))
            <div>写真3</div>

                <div>
                    <img width="170" src="/storage/{{$product['image_3']}}" alt="">
                </div>
            @endif

            @if (!is_null($product['image_4']))
            <div>写真4</div>

                <div>
                    <img width="170" src="/storage/{{$product['image_4']}}" alt="">
                </div>
            @endif
    </div>

    <div>
        <span>商品説明</span>
        <span>{{$product['product_content']}}</span>
    </div>

    <form action="{{ route('registerProduct')}}" method="POST">
        @csrf
        <input type="hidden" name="product_name" value="<?= $product['product_name']; ?>">
        <input type="hidden" name="product_category_id" value="{{ $product['product_category_id'] }}">
        <input type="hidden" name="product_subcategory_id" value="{{ $product['product_subcategory_id'] }}">
        <input type="hidden" name="product_content" value="{{ $product['product_content'] }}">
        <input type="hidden" name="image_1" value="{{ $product['image_1'] }}">
        <input type="hidden" name="image_2" value="{{ $product['image_2'] }}">
        <input type="hidden" name="image_3" value="{{ $product['image_3'] }}">
        <input type="hidden" name="image_4" value="{{ $product['image_4'] }}">
        <button>登録する</button>
    </form>
    <button onclick="history.back()">前に戻る</button>

</body>
</html>
