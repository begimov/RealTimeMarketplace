<?php

namespace App\Http\Controllers\Webapi;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::all());

        $categories = CategoryResource::collection(Category::all());

        return compact('products', 'categories');
    }

    public function store(StoreProductRequest $request)
    {
        $newProduct = Product::create($request->all());

        return new ProductResource($newProduct);
    }
}
