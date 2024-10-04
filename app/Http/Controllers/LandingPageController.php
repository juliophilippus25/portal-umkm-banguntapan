<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Business;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class LandingPageController extends Controller
{
    public function home() {
        $products = Product::with('business')->orderBy('created_at', 'desc')->paginate(6);
        $advertisements = Advertisement::with('business')->orderBy('created_at', 'desc')->paginate(4);

        return view('landing-page.home', compact('products', 'advertisements'));
    }

    public function businesses() {
        $businesses = Business::with(['businessType', 'subDistrict'])->orderBy('created_at', 'desc')->get();

        return view('landing-page.businesses.businesses', compact('businesses'));
    }

    public function detailBusiness($id) {
        $business = Business::with([
            'user', 
            'businessType', 
            'subDistrict', 
            'products', 
            'products.advertisements', 
            'advertisements',
            'advertisements.advertisementProducts'
            ])->findOrFail($id);

        // Paginasi untuk produk
        $products = $business->products()->paginate(6);

        // Paginasi untuk iklan
        $advertisements = $business->advertisements()->paginate(4);

        return view('landing-page.businesses.detailBuss', compact('business', 'products', 'advertisements'));
    }

    public function advertisements() {
        $advertisements = Advertisement::with(['business', 'advertisementProducts'])->orderBy('created_at', 'desc')->paginate(9);

        return view('landing-page.advertisements.advertisements', compact('advertisements'));
    }

    public function detailAdvertisement($id) {
        $advertisement = Advertisement::with(['business', 'advertisementProducts'])->find($id);
        return view('landing-page.advertisements.detailAds', compact('advertisement'));
    }

    public function products(Request $request) {
        $query = Product::with(['business', 'productType']);

        // Filter berdasarkan tipe produk
        if ($request->filled('product_type')) {
            $query->where('product_type_id', $request->product_type);
        }
    
        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }
    
        $products = $query->paginate(9); // Ambil produk dengan pagination
        $productTypes = ProductType::all(); // Ambil semua tipe produk

        return view('landing-page.products.products', compact('products' , 'productTypes'));
    }

    public function detailProduct($id) {
        $product = Product::with(['business', 'productType'])->orderBy('created_at', 'desc')->find($id);
        return view('landing-page.products.detailPrds', compact('product'));
    }
}
