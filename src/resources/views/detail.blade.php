@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection


@section('content')
<div class="detail-contents">
    <form action="/products/{{$product->id}}/update" method ="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
            <div class="top-contents">
                <div class="left-content">
                    <p><span class="span-item">商品一覧</span> > {{$product->name}}</p>
                    <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
                    <output id="list" class="image_output"></output>
                    <input type="file" id="product_image" class="image" name="product_image">
                    <p class="register-form__error-message">
                    @error('product_image')
                    {{ $message }}
                    @enderror
                    </p>
                </div>

                <div class="right-content">
                    <label class="detail-label">商品名</label>
                    <input type="text" value="{{$product->name}}" name="product_name" class="text">
                    <p class="register-form__error-message">
                    @error('product_name')
                    {{ $message }}
                    @enderror
                    </p>
                    <label class="detail-label">値段</label>
                    <input type="text" value="{{$product->price}}" name="product_price" class="text">
                    <p class="register-form__error-message">
                    @error('product_price')
                    {{ $message }}
                    @enderror
                    </p>
                    <label class="detail-label">季節</label>
                    <div class="season-container">
                    @foreach ($seasons as $season)
                        @if($product->checkSeason($season,$product) == "no")
                            <input type="checkbox" id="season_id" value="{{$season->id}}">
                        @elseif($product->checkSeason($season,$product) == "yes")
                            <input type="checkbox" id="season_id" value="{{$season->id}}" checked>
                        @endif
                        <label for="season_id" class="season-label">{{$season->name}}</label>
                    @endforeach
                    </div>
                    <p class="register-form__error-message">
                    @error('season_id')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
            </div>

            <div class="under-content">
                <label class="detail-label">商品説明</label>
                <textarea cols="30" rows="5" name="product_description" class="product-description__textarea">{{$product->description}}</textarea>
                <p class="register-form__error-message">
                    @error('product_description')
                    {{ $message }}
                    @enderror
                    </p>
                <div class="button-content">
                    <a href="/products" class="button-back">戻る</a>
                    <button type="submit" class="button-change">変更を保存</button>
                </div>
            </div>
    </form>

    <div class="trash-can-content">
        <form action="/products/{{$product->id}}/delete" method="POST" class="delete-form">
        @method('DELETE')
        @csrf
        <button type="submit" class="delete-button">
            <img src="{{ asset('/images/trash-can.png') }}"  alt="ゴミ箱の画像" class="img-trash-can"/>
        </button>
        </form>
    </div>
    <script>
        document.getElementById('product_image').onchange = function(event){

            initializeFiles();

            var files = event.target.files;

            for (var i = 0, f; f = files[i]; i++) {
                var reader = new FileReader;
                reader.readAsDataURL(f);

                reader.onload = (function(theFile) {
                    return function (e) {
                        var div = document.createElement('div');
                        div.className = 'reader_file';
                        div.innerHTML += '<img class="reader_image" src="' + e.target.result + '" />';
                        document.getElementById('list').insertBefore(div, null);
                    }
                })(f);
            }
        };

        function initializeFiles() {
            document.getElementById('list').innerHTML = '';
        }
    </script>
</div>


@endsection