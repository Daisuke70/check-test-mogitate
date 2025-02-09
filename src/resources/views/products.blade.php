@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css')}}">
@endsection

@section('content')
    <div class="products-contents">
        <div class="left-contents">
        <h1>商品一覧</h1>
        <form class="search-form" action="/products/search" method="post">
        @csrf
                <input type="text" name="keyword" class="keyword" placeholder="商品名で検索">
                <button type="submit" class="submit-button">検索</button>
                <label class="select-label">価格順で表示</label>
                <select class="select" name="sort" id="sort">
                    <option value="">価格で並べ替え</option>
                    <option value="high_price">高い順に表示</option>
                    <option value="low_price">低い順に表示</option>
                </select>
        </form>
        @if (@isset($sort)&& $sort != "")
            <div class="sort_contents">
                <p class="searched_data">{{$sort}}</p>
                    <a href="/products">
                        <img src="{{ asset('/images/close-icon.png') }}"  alt="閉じるアイコン" class="img-close-icon"/>
                    </a>
            </div>
        @endif
        </div>
        
        <div class="right-contents">
            <p class="message">{{session('message')}}</p>
            <a class="register__button" href="/products/register">+ 商品を追加</a>
            <div class="product-contents">
                @foreach ($products as $product)
                <div class="product-card">
                    <a href="/products/detail/{{$product->id}}" class="product-link"></a>
                    <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
                        <div class="name-price">
                            <p>{{$product->name}}</p>
                            <p>{{$product->price}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-content">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection