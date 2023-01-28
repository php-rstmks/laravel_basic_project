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

<form action="{{route('registerProduct')}}" method="POST">
@csrf
    <div>
        <span>商品名</span>
        <input type="text" name="product_name">
    </div>

    <div>
        商品カテゴリ
        <div>
            {{-- 大カテゴリ --}}
            <select name="product_category_id" id="js-ajax-change-subcategories" required>
                <option value="">選択してください</option>
                @if(!empty($product_categories))
                    @foreach($product_categories as $product_category)
                        {{-- @if(!empty(old('product_category_id'))) --}}
                        <option value="{{ $product_category->id }}" {{ (old('product_category_id') == $product_category->id) ? 'selected': '' }}>{{ $product_category->name }}</option>
                        {{-- @else
                            <option value="{{ $product_category->id }}" {{ ($product_category_id == $product_category->id) ? 'selected': '' }}>{{ $product_category->name }}</option>
                        @endif --}}
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
            <div class="preview-image-wrapper">
                @if(!empty($image_1))
                    <img class="js-preview1 upload-image" src="{{ "/uploads/".$image_1 }}">
                @else
                    <img class="js-preview1 upload-image" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_1">アップロード
                <input class="js-image-uploader1" id="image_1" style="display: none;" type="file">
                <input class="js-image-path-hidden1" type="hidden" name="image_1" value="{{ $image_1 ?? '' }}">
            </label>
        @endif

        <p>写真２</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg2" style="color: red"></div>

        {{-- デフォルトの状態 --}}
        @if (empty(old('image_2')))
            <div class="preview-image-wrapper">
                @if(!empty($image_2))
                    <img class="js-preview2 upload-image" src="{{ "/uploads/".$image_2 }}">
                @else
                    <img class="js-preview2 upload-image" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_2">アップロード
                <input class="js-image-uploader2" id="image_2" style="display: none;" type="file">
                <input class="js-image-path-hidden2" type="hidden" name="image_2" value="{{ $image_2 ?? '' }}">
            </label>
        @endif

        <p>写真３</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg3" style="color: red"></div>

        {{-- デフォルトの状態 --}}
        @if (empty(old('image_3')))
            <div class="preview-image-wrapper">
                @if(!empty($image_3))
                    <img class="js-preview3" src="{{ "/uploads/".$image_3 }}">
                @else
                    <img class="js-preview3" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_3">アップロード
                <input class="js-image-uploader3" id="image_3" style="display: none;" type="file">
                <input class="js-image-path-hidden3" type="hidden" name="image_3" value="{{ $image_3 ?? '' }}">
            </label>
        @endif

        <p>写真４</p>

        {{-- エラー表示用 --}}
        <div class="image-err-msg4" style="color: red"></div>

        {{-- デフォルトの状態 --}}
        @if (empty(old('image_4')))
            <div class="preview-image-wrapper">
                @if(!empty($image_4))
                    <img class="js-preview1" src="{{ "/uploads/".$image_1 }}">
                @else
                    <img class="js-preview1" widt="100" height="130" style="object-fit: cover;" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_4">アップロード
                <input class="js-image-uploader4" id="image_4" style="display: none;" type="file">
                <input class="js-image-path-hidden1" type="hidden" name="image_1" value="{{ $image_4 ?? '' }}">
            </label>
        @endif

    </div>



    <div>
        <span>商品説明</span>
        <textarea name="product_content"></textarea>
    </div>
</form>

<script src="{{url('js/main.js')}}"></script>
<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    const categorySelectBox = document.querySelector('#js-ajax-change-subcategories')

    const subCategorySelectBox = document.querySelector('#js-ajax-target-field')

    categorySelectBox.addEventListener("change", (e) => {

        const categoryId = e.target.value

        fetch('/set-subcategory/' + categoryId, {
            method: 'GET',
            headers: {
                'X-CSRF-Token': token,
            }
        })
        .then(response => {
            return response.json();
        })
        .then(json => {

            // サブカテゴリの中身をすべて削除
            while (subCategorySelectBox.firstChild)
            {
                subCategorySelectBox.removeChild(subCategorySelectBox.firstChild)
            }

            const subCategoriesLinkedWithCategory = json.product_subcategories

            // option tagを作成
            subCategoriesLinkedWithCategory.forEach(subCategory => {
                const optionTag = document.createElement("option")
                optionTag.setAttribute("value", subCategory.id)
                optionTag.innerHTML = subCategory.name

                console.log(optionTag)

                subCategorySelectBox.append(optionTag)
            });
        })

    })

    $(function() {

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $('.js-image-uploader1').on('change', function (e) {
            // アップロードしたファイル情報を取得
            var file = this.files[0];

            //フォームデータにアップロードファイルの情報追加
            var form = new FormData();

            //フォームデータにアップロードファイルの情報追加
            form.append("image_1", file);

            $.ajax({
                url: '{{ route('registerImage') }}',
                cache: false,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                data: form,
            }).done((data) => {
                console.log(data);
                $('.js-preview1').attr('src', '/storage/' + data['returnFileName1']);
                $('.js-image-path-hidden1').attr('value', data['returnFileName1']);
            }).fail((error) => {
                if(error.statusText == 'Unprocessable Entity') {
                    console.log(error.statusText);
                    $('.image-err-msg1').append('<div>画像は10MBでかつjpg、jpeg、png、gifにする必要があります。</div>')
                }
            })
        });

        // 画像２

        $('.js-image-uploader2').on('change', function (e) {
            // アップロードしたファイル情報を取得
            var file = this.files[0];

            //フォームデータにアップロードファイルの情報追加
            var form = new FormData();

            //フォームデータにアップロードファイルの情報追加
            form.append("image_2", file);

            $.ajax({
                url: '{{ route('registerImage') }}',
                cache: false,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                data: form,
            }).done((data) => {
                console.log(data);
                $('.js-preview2').attr('src', '/storage/' + data['returnFileName1']);
                $('.js-image-path-hidden2').attr('value', data['returnFileName1']);
            }).fail((error) => {
                if(error.statusText == 'Unprocessable Entity') {
                    console.log(error.statusText);
                    $('.image-err-msg2').append('<div>画像は10MBでかつjpg、jpeg、png、gifにする必要があります。</div>')
                }
            })
        });

        $('.js-image-uploader3').on('change', function (e) {
            // アップロードしたファイル情報を取得
            var file = this.files[0];

            //フォームデータにアップロードファイルの情報追加
            var form = new FormData();

            //フォームデータにアップロードファイルの情報追加
            form.append("image_3", file);

            $.ajax({
                url: '{{ route('registerImage') }}',
                cache: false,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                data: form,
            }).done((data) => {
                console.log(data);
                $('.js-preview3').attr('src', '/storage/' + data['returnFileName1']);
                $('.js-image-path-hidden3').attr('value', data['returnFileName1']);
            }).fail((error) => {
                if(error.statusText == 'Unprocessable Entity') {
                    console.log(error.statusText);
                    $('.image-err-msg3').append('<div>画像は10MBでかつjpg、jpeg、png、gifにする必要があります。</div>')
                }
            })
        });

        // 画像４
        $('.js-image-uploader4').on('change', function (e) {
            // アップロードしたファイル情報を取得
            var file = this.files[0];

            //フォームデータにアップロードファイルの情報追加
            var form = new FormData();

            //フォームデータにアップロードファイルの情報追加
            form.append("image_4", file);

            $.ajax({
                url: '{{ route('registerImage') }}',
                cache: false,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                data: form,
            }).done((data) => {
                console.log(data);
                $('.js-preview4').attr('src', '/storage/' + data['returnFileName1']);
                $('.js-image-path-hidden4').attr('value', data['returnFileName1']);
            }).fail((error) => {
                if(error.statusText == 'Unprocessable Entity') {
                    console.log(error.statusText);
                    $('.image-err-msg4').append('<div>画像は10MBでかつjpg、jpeg、png、gifにする必要があります。</div>')
                }
            })
        });
    })
</script>
</body>
</html>
