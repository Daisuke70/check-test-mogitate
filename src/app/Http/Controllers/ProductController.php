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
        $dir = 'image';

        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        $product_data = new Product();
        $product_data->product= $_POST["product"];
        $product_data->price= $_POST["price"];
        $product_data->image= 'storage/' . $dir . '/' . $file_name;
        $product_data->description= $_POST["description"];
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
