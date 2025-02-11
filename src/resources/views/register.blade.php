@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
  <h1 class="register-form__heading content__heading">商品登録</h1>

    <form class="register-form__form" action="/product/upload" method="post" enctype="multipart/form-data">
      @csrf
        <label class="register-form__label">商品名<span class="register-form__required">必須</span></label>
        <input class="register-form__input" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="商品名を入力">
        <p class="register-form__error-message">
          @error('product_name')
          {{ $message }}
          @enderror
        </p>

        <label class="register-form__label">値段<span class="register-form__required">必須</span></label>
        <input class="register-form__input" type="text" name="product_price" value="{{ old('product_price') }}" placeholder="値段を入力">
        <p class="register-form__error-message">
          @error('product_price')
          {{ $message }}
          @enderror
        </p>

        <label class="register-form__label">商品画像<span class="register-form__required">必須</span></label>
        <output id="list" class="image_output"></output>
        <input type="file" id="product_image" class="image" name="product_image">
        <p class="register-form__error-message">
          @error('product_image')
          {{ $message }}
          @enderror
        </p>

        <label class="register-form__label">季節<span class="register-form__required">必須</span><span class="register-form__check">複数選択可</span></label>
        @foreach ($seasons as $season)
          <input type="checkbox" id="season_id" value="{{$season->id}}" name="season_id">
          <label for="season_id">{{$season->name}}</label>
        @endforeach
          <p class="register-form__error-message">
            @error('season_id')
            {{ $message }}
            @enderror
          </p>

        <label class="register-form__label"></label>商品説明<span class="register-form__required">必須</span></label>
        <textarea class="register-form__textarea" name="product_description" id="" cols="30" rows="10"
          placeholder="商品の説明を入力">{{ old('product_description') }}</textarea>
        <p class="register-form__error-message">
          @error('product_description')
          {{ $message }}
          @enderror
        </p>

      <div class="register-form__button-content">
        <a href= "/products" class="back">戻る</a>
        <button type="submit" class="button-register">登録</button>
      </div>
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