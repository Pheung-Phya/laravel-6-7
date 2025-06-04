<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductDetailResorce;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){
        $products = Product::paginate(10);
        return ProductDetailResorce::collection($products);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'desc' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $product = Product::create( $validated);
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);

    }
}
