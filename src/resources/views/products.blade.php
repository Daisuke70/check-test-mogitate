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
                    <option value="high-score" a href="{{ url('/products?sort=desc') }}">高い順に表示</option>
                    <option value="low-score" a href="{{ url('/products?sort=asc') }}">低い順に表示</option>
                </select>
        </form>
        
        </div>
        
        <div class="right-contents">
            <a class="register__link" href="/products/register">+ 商品を追加</a>
            <div class="product-contents">
                @foreach ($products as $product)
                <div class="product-card">
                    <a href="/products/{{$product->id}}" class="product-link"></a>
                    <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
                        <div class="detail-content">
                            <p>{{$product->name}}</p>
                            <p>{{$product->price}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="pagination-content">
            {{ $products->links('pagination::bootstrap-4')}}
            </div>
        </div>
@endsection