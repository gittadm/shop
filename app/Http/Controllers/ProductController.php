<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderProductsRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService) {

    }

    public function index()
    {
        $products = Product::orderBy('name')->get();

        return view('products', compact('products'));
    }

    public function getByIds(OrderProductsRequest $request)
    {
        $products = $this->productService->getOrderProducts($request->validated('products'));

        return response()->json(['products' => $products]);
    }
}
