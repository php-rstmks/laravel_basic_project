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

{{-- <form action="{{route('registerProduct')}}" method="POST"> --}}
@csrf
    <div>
        <span>商品名</span>
        <input type="text" name="product_name">
    </div>

    <div>
        <span>商品写真</span>
        <p>写真１</p>

        {{-- エラー表示用 --}}
        <div class="image-err-message"></div>

        {{-- <label>
            <input class="image-uploader1" type="file" name="file">アップロード
        </label> --}}


        @if(!empty(old('image_1')))
            <div class="preview-image-wrapper">
                <img class="js-preview1 upload-image" src="{{ "/uploads/".old('image_1') }}">
            </div>
            <label class="btn btn-back" for="image_1">アップロード
                <input class="js-image-uploader1" id="image_1" style="display: none;" type="file">
                <input class="js-image-path-hidden1" type="hidden" name="image_1" value="">
            </label>

        {{-- バリデーションで弾かれたとき --}}
        @else
            <div class="preview-image-wrapper">
                @if(!empty($image_1))
                    <img class="js-preview1 upload-image" src="{{ "/uploads/".$image_1 }}">
                @else
                    <img class="js-preview1 upload-image" src="">
                @endif
            </div>
            <label class="btn btn-back" for="image_1">アップロード
                <input class="js-image-uploader1" id="image_1" style="display: none;" type="file">
                <input class="js-image-path-hidden1" type="hidden" name="image_1" value="{{ $image_1 ?? '' }}">
            </label>
        @endif








        <div>
            <p>写真２</p>
            <input type="file" name="image_2" value="アップロード">
        </div>
        <div>
            <p>写真３</p>
            <input type="file" name="image_3" value="アップロード">
        </div>
        <div>
            <p>写真４</p>
            <input type="file" name="image_4" id="">
        </div>
    </div>

    <div>
        <span>商品説明</span>
        <textarea name="product_content"></textarea>
    </div>
</form>

<script src="{{url('js/main.js')}}"></script>
<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    $(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // 'X-CSRF-TOKEN': token,
                }
        });
        $('.js-image-uploader1').on('change', function (e) {
            // アップロードしたファイル情報を取得
            var file = this.files[0];

            console.log(file);

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
                // コントローラから受け取ったデータ(検索結果)をdataに代入し以下の処理を実行します
            }).done((data) => {
                console.log(data);
                $('.js-preview1').attr('src', '/storage/' + data['returnFileName1']);
                $('.js-image-path-hidden1').attr('value', data['returnFileName1']);
            }).fail((error) => {
                console.log(error.statusText)
                if(error.statusText == 'Payload Too Large') {
                    console.log(error.statusText)
                    // $('').append('<p>'+error.statusText+'</p>');
                    $('.js-image1-error-target').append('<p>ファイルのサイズが大きすぎます。10MB以下にしてください</p>')
                }
                if(error.statusText == 'Unprocessable Entity') {
                    console.log(error.statusText);
                    $('.js-image1-error-target').append('<p>１０MBまでのjpg、jpeg、png、gifのファイルのみアップロード可能です</p>')
                }
            })
        });
    })
</script>
</body>
</html>
