<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index(){
        $pTypes = ProductType::get();
        return view('admin.productType.index', compact('pTypes'));
    }
}
