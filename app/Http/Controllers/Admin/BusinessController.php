<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    public function index(){
        $businesses = Business::with(['businessType', 'subDistrict'])
        ->whereHas('user', function ($query) {
            $query->whereNotNull('verified_by');
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.businesses.index', compact('businesses'));
    }

    public function show($id){
        $business = Business::with([
            'user', 
            'businessType', 
            'subDistrict', 
            'products', 
            'products.advertisements', 
            'advertisements',
            'advertisements.advertisementProducts'
            ])->findOrFail($id);
        return view('admin.businesses.show', compact('business'));
    }
}
