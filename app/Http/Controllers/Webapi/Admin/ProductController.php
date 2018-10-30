<?php

namespace App\Http\Controllers\Webapi\Admin;

use App\Models\Image;
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
        $products = ProductResource::collection(auth()->user()->products()->with('category')->get());

        $categories = CategoryResource::collection(Category::all());

        return compact('products', 'categories');
    }

    public function store(StoreProductRequest $request)
    {
        $newProduct = Product::make($request->all());

        $request->user()->products()->save($newProduct);

        $newProduct->save();

        $newProduct->image()->save(Image::find($request->image_id));

        return new ProductResource($newProduct);
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $payload = $request->only(['category_id', 'name', 'price']);

        $product->update($payload);
    }
}
