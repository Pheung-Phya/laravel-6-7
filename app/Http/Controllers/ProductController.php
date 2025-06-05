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

    public function show($id){
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Search found',
            'product' => $product
        ]);
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

    public function update( $id,Request $request){
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'desc' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);
         $product->update($validated);
            return response()->json([
            'status' => 'success',
            'message' => 'Product updated successfully',
            'product' => $product
        ]);

    }

    public function delete($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
        $product->delete();
    }

}