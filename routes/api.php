<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('categories', [CategoryController::class, 'store']);
Route::get('categories',[CategoryController::class,'index']);
Route::put('categories/{id}',[CategoryController::class,'update']);
Route::delete('categories/{id}',[CategoryController::class,'delete']);

Route::post('products',[ProductController::class,'store']);
Route::get('products',[ProductController::class,'index']);
