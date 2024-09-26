<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::with(['business', 'productType'])->orderBy('created_at', 'desc')->get();
        
        return view('admin.products.index', compact('products'));
    }
}
