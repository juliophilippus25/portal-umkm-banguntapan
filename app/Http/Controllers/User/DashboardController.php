<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $countProduct = $this->countProduct();
        $countAd = $this->countAd();

        return view('user.dashboard', compact('countProduct', 'countAd'));
    }

    private function countProduct() {
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        // Mengambil ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();

        return Product::where('business_id', $businessId)->count();
    }

    private function countAd() {
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        // Mengambil ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();
         
        return Advertisement::where('business_id', $businessId)->count();
    }
}
