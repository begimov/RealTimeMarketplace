<?php

namespace App\Http\Controllers\Webapi\Catalog;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->published()
            ->whereCategoryId($request->category_id)
            ->where('name', 'like', '%' . $request->search . '%')
            ->get();

        return ProductResource::collection($products);
    }
}
