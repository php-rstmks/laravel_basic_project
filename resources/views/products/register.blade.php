<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .upload-button {
            padding: 10px 10px;
            color: #ffffff;
            background-color: #384878;
            cursor: pointer;
        }


        input[type="file"] {
            display: none;
        }
        label {
            padding: 10px 40px;
            color: #ffffff;
            background-color: #384878;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>商品登録</h2>

@if ($errors->any())

    @foreach($errors->all() as $error)
        <div style="color: red">{{ $error }}</div>
    @endforeach
@endif

<form action="{{route('registerProductConfPage')}}" method="POST">
@csrf
    <div>
        <span>商品名</span>
        <input type="text" name="product_name" value="{{old('product_name')}}">
    </div>

    <div>
        商品カテゴリ
        <div>
            {{-- 大カテゴリ --}}
            <select name="product_category_id" id="js-ajax-change-subcategories">
                <option value="">選択してください</option>
                @if(!empty($product_categories))
                    @foreach($product_categories as $product_category)
                        <option value="{{ $product_category->id }}" {{ (old('product_category_id') == $product_category->id) ? 'selected': '' }}>{{ $product_category->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    {{-- 小カテゴリ --}}
    <div id="subcategory-box">
        <select name="product_subcategory_id" id="js-ajax-target-field">
            @if(!empty(old('product_subcategory_id')))
                @foreach($product_subcategories as $product_subcategory)
                    @if($product_subcategory->product_category_id == old('product_category_id'))
                        <option value="{{ $product_subcategory->id }}" {{ (old('product_subcategory_id') == $product_subcategory->id) ? 'selected': '' }}>{{ $product_subcategory->name }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>


    <div>
        <span>商品写真</span>

        {{-- 写真1 --}}
        <p>写真１</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg1" style="color: red"></div>

        {{-- デフォルトの状態 --}}
        @if (empty(old('image_1')))
            <div>

                @if (empty($image_1))
                    <img class="image-preview1" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_1">アップロード
                <input class="image-uploader1" id="image_1" style="display: none;" type="file">
                <input class="image-path-hidden1" type="hidden" name="image_1" value="{{ $image_1 ?? '' }}">
            </label>
        @endif

        <p>写真２</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg2" style="color: red"></div>

        @if (empty(old('image_2')))
            <div>
                @if(empty($image_2))
                    <img class="image-preview2 upload-image" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_2">アップロード
                <input class="image-uploader2" id="image_2" style="display: none;" type="file">
                <input class="image-path-hidden2" type="hidden" name="image_2" value="{{ $image_2 ?? '' }}">
            </label>
        @endif

        <p>写真３</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg3" style="color: red"></div>

        {{-- デフォルトの状態 --}}
        @if (empty(old('image_3')))
            <div>
                @if(empty($image_3))
                    <img class="image-preview3" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_3">アップロード
                <input class="image-uploader3" id="image_3" style="display: none;" type="file">
                <input class="image-path-hidden3" type="hidden" name="image_3" value="{{ $image_3 ?? '' }}">
            </label>
        @endif

        <p>写真４</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg4" style="color: red"></div>

        @if (empty(old('image_4')))
            <div>
                @if(empty($image_4))
                    <img class="image-preview4" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_4">アップロード
                <input class="image-uploader4" id="image_4" style="display: none;" type="file">
                <input class="image-path-hidden4" type="hidden" name="image_4" value="{{ $image_4 ?? '' }}">
            </label>
        @endif

    </div>

    <div>
        <span>商品説明</span>
        <textarea name="product_content">{{old('product_content')}}</textarea>
    </div>

    <button>確認画面へ</button>
    <button><a href="{{route('topPage')}}">トップ画面へ</a></button>

</form>

<script src="{{url('js/products/register.js')}}"></script>
</body>
</html>
