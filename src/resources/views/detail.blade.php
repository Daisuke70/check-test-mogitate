@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="all-contents">
        <form action="/products/update/{{$product->id}}" method ="POST">
        @csrf
            <div class="top-contents">
                <div class="left-content">
                    <p><span class="span-item">商品一覧></span>{{$product->name}}</p>
                    <img src="{{ asset($product->image) }}"  alt="商品画像" class="img-content"/>
                    <output id="list" class="image_output"></output>
                    <input type="file" id="product_image" class="image" name="product_image">
                </div>

                <div class="right-content">
                    <label class="name-label">商品名</label>
                    <input type="text" placeholder="{{$product->name}}" name="product_name" class="text">
                    <label class="price-label">値段</label>
                    <input type="text" placeholder="{{$product->price}}" name="product_price" class="text">
                    <label class="season-label">季節</label>
                    @foreach ($seasons as $season)
                        <label for="season">{{$season->name}}</label>
                        @if($product->checkSeason($season,$product) == "no")
                            <input type="checkbox" id="season" value="{{$season->id}}">
                        @elseif($product->checkSeason($season,$product) == "yes")
                            <input type="checkbox" id="season" value="{{$season->id}}" checked>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="under-content">
                <label class="description-label">商品説明</label>
                <textarea cols="30" rows="5" name="product_description" class="product-description">{{$product->description}}</textarea>
                <div class="button-content">
                    <a href="/products" class="back">戻る</a>
                    <button type="submit" class="button-change">変更を保存</button>
                    <div class="trash-can-content">
                        <a href="/products/{{$product->id}}/delete">
                            <img src="{{ asset('/images/trash-can.png') }}"  alt="ゴミ箱の画像" class="img-trash-can"/>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection