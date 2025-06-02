<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        // $category = new Category();
        // $category->name = $validator['name'];
        // $category->save();
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);  // 200 
    }
}