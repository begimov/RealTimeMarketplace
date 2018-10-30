<?php

namespace App\Http\Controllers\Webapi\Catalog;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\PurchaseRequested;
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

    public function purchase(Request $request)
    {
        broadcast(new PurchaseRequested(
            array_merge(
                $request->all()['params'], 
                ['user_id' => $request->user()->id]
            )
        ))->toOthers();

        dd($request->all());
    }
}
