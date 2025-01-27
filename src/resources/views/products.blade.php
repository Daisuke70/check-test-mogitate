@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css')}}">
@endsection

@section('content')
    <div class="products-page__top">
        <h2 class="products">商品一覧</h2>
        <a class="register__link" href="/products/register">+ 商品を追加</a>
    </div>

    <div class="products-page__content">
        <form class="search-form" action="/products/search" method="post">
            <input class="products__search-form" type="text" name="name" value="{{ old('name') }} "placeholder="商品名で検索">
            <div class="search-form__actions">
                <input class="search-form__search-btn btn" type="submit" value="検索">
            </div>
            
        </form>
    </div>


@endsection