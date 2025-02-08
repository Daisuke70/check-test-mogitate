<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();
        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];
        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);
        return view('products', compact('products'));
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

    public function getSearch(Request $request)
    {
        $query = Product::query();
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
        $query->where('name', 'LIKE', "%")->limit(10)->get();
        }
        
        $products = $query->get();

        $sort = $request->query('sort', 'asc');
        if (!in_array($sort, ['desc'])) {
        $sort = 'asc';
        }
        $products = Product::orderBy('price', $sort)->get();

        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);

        $seasons = Season::all();
        return view('products')->with(compact('products', 'sort'));
    }

    public function postSearch(Request $request)
    {
        $products = Product::query();
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {
        $products->where('name', 'LIKE', "%")->limit(10)->get();
        }

        $sort = $request->query('sort', 'asc');
        if (!in_array($sort, ['desc'])) {
        $sort = 'asc';
        }
        $products = Product::orderBy('price', $sort)->get();

        $perPage = 6;
        $page = Paginator::resolveCurrentPage('page');
        $pageData = $products->slice(($page - 1) * $perPage, $perPage);
        $options = [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page'
        ];

        $products = new LengthAwarePaginator($pageData, $products->count(), $perPage, $page, $options);

        $seasons = Season::all();
        return view('products')->with(compact('products', 'sort'));
    }

}
