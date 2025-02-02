@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
  <h2 class="register-form__heading content__heading">商品登録</h2>

  <div class="register-form__inner">
    <form class="register-form__form" action="/products/register" method="post" enctype="multipart/form-data">
      @csrf
      <div class="register-form__group">
        <label class="register-form__label" for="product">商品名
          <span class="register-form__required">必須</span>
        </label>
        <input class="register-form__input" type="text" name="product" id="product" value="{{ old('product') }}" placeholder="商品名を入力">
        <p class="register-form__error-message">
          @error('product')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="register-form__group">
        <label class="register-form__label" for="price">値段
          <span class="register-form__required">必須</span>
        </label>
        <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
        <p class="register-form__error-message">
          @error('price')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="register-form__group">
        <label class="register-form__label" for="image">商品画像
          <span class="register-form__required">必須</span>
        </label>
        <label class="register-form-image__label" for="image">
          <div class="register-form-image">ファイルを選択</div>
          <input class="register-form-image__input" type="file" name="image" id="image" accept=".png, .jpeg" value="{{ old('image') }}" style="display:none">
        </label>
        <p class="register-form__error-message">
          @error('image')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="register-form__group">
        <label class="register-form__label">季節
          <span class="register-form__required">必須</span>
          <span class="register-form__required-2">複数選択可</span>
        </label>
        <div class="register-form__season-inputs">
          <div class="register-form__season-option">
            <label class="register-form__season-label">
              <input class="register-form__season-input" name="season" type="radio" id="spring" value="1" {{
                old('season')==1 ||old('season')}}>
              <span class="register-form__season-text">春</span>
            </label>
          </div>
          <div class="register-form__season-option">
            <label class="register-form__season-label">
              <input class="register-form__season-input" name="season" type="radio" id="summer" value="2" {{
                old('season')==2 || old('season')}}>
              <span class="register-form__season-text">夏</span>
            </label>
          </div>
          <div class="register-form__season-option">
            <label class="register-form__season-label">
              <input class="register-form__season-input" name="season" type="radio" id="fall" value="3" {{
                old('season')==3 || old('season')}}>
              <span class="register-form__season-text">秋</span>
            </label>
          </div>
          <div class="register-form__season-option">
            <label class="register-form__season-label">
              <input class="register-form__season-input" name="season" type="radio" id="winter" value="4" {{
                old('season')==4 || old('season')}}>
              <span class="register-form__season-text">冬</span>
            </label>
          </div>
          </div>
          <p class="register-form__error-message">
            @error('season')
            {{ $message }}
            @enderror
          </p>
        </div>

      <div class="register-form__group">
        <label class="register-form__label" for="product-description">
          商品説明<span class="register-form__required">必須</span>
        </label>
        <textarea class="register-form__textarea" name="product-description" id="" cols="30" rows="10"
          placeholder="商品の説明を入力">{{ old('product-description') }}</textarea>
        <p class="register-form__error-message">
          @error('product-description')
          {{ $message }}
          @enderror
        </p>
      </div>

      <div class="register-form__btn-inner">
        <input class="register-form__back-btn btn" type="submit" value="戻る" name="back">
        <input class="register-form__register-btn" type="submit" value="登録" name="register">
      </div>
    </form>
  </div>
</div>
@endsection