<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;

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
}
