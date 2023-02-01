<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <button style="float: right"><a href="{{route('topPage')}}">トップに戻る</a></button>
    <h1>商品レビュー編集</h1>
    <div>

        <div>{{$review->product->name}}</div>
        <div>総合評価</div>
        @for ($i = 1; $i <= $avg_review; $i++)
            <span>★</span>
        @endfor
        {{$review->evaluation}}
    </div>

    <hr>
    <form method="POST" action="{{ route('reviewEditConfPage', $review) }}">
        @csrf
        <div style="display: flex;">
            <div>商品評価</div>
            <div>
                <select style="width: 100px" name="evaluation">
                    @if(!empty(old('evaluation')))
                    <option value="1" {{ old('evaluation') == '1'? 'selected':'' }}>1</option>
                    <option value="2" {{ old('evaluation') == '2'? 'selected':'' }}>2</option>
                    <option value="3" {{ old('evaluation') == '3'? 'selected':'' }}>3</option>
                    <option value="4" {{ old('evaluation') == '4'? 'selected':'' }}>4</option>
                    <option value="5" {{ old('evaluation') == '5'? 'selected':'' }}>5</option>
                    @else
                        <option value="1" {{ $review->evaluation == '1'? 'selected':'' }}>1</option>
                        <option value="2" {{ $review->evaluation == '2'? 'selected':'' }}>2</option>
                        <option value="3" {{ $review->evaluation == '3'? 'selected':'' }}>3</option>
                        <option value="4" {{ $review->evaluation == '4'? 'selected':'' }}>4</option>
                        <option value="5" {{ $review->evaluation == '5'? 'selected':'' }}>5</option>
                    @endif
                </select>
            </div>
        </div>

        <div style="display: flex;">
            <div>商品コメント</div>
            <div>
                @if(!empty(old('comment')))
                <textarea name="comment">{!! nl2br(e(old('comment'))) !!}</textarea>
                @else
                    <textarea name="comment" id="" style="width: 400px; height: 200px">{!! nl2br(e($review->comment)) !!}</textarea>
                @endif
            </div>
        </div>


        @if ($errors->any())

            @foreach($errors->all() as $error)
                <div style="color: red">{{ $error }}</div>
            @endforeach
        @endif
        <button>商品レビュー編集確認</button>
    </form>
    <button><a href="{{route('controlReviewPage')}}">商品レビュー管理へ戻る</a></button>
</body>
</html>
