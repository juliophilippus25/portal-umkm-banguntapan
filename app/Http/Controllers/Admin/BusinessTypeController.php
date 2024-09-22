<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BusinessType;

class BusinessTypeController extends Controller
{
    public function index(){
        $bTypes = BusinessType::get();
        return view('admin.businessType.index', compact('bTypes'));
    }
}
