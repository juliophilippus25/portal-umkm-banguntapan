<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;

class BusinessController extends Controller
{
    public function index(){
        $businesses = Business::with(['businessType', 'subDistrict'])->get();

        return view('admin.businesses.index', compact('businesses'));
    }
}
