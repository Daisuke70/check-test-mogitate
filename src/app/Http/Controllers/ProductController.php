<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function getProducts()
    {
        return view('products');
    }

    public function upload(ProductRequest $request)
    {
        $dir = 'images';

        $file_name = $request->file('product_image')->getClientOriginalName();
        $request->file('product_image')->storeAs('public/' . $dir, $file_name);

        $product_data = new Product();
        $product_data->name= $_POST["product_name"];
        $product_data->price= $_POST["product_price"];
        $product_data->image= 'storage/' . $dir . '/' . $file_name;
        $product_data->description= $_POST["product_description"];
        $product_data->save();

        $products = Product::all();
        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);

        return redirect('/products');
    }
}
