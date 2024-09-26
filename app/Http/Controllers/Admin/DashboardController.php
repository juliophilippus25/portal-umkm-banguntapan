<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $admin = Auth::guard('admin')->user();
        $countUnverifiedUsers = $this->countUnverifiedUsers();
        $getUnverifiedUsers = $this->getUnverifiedUsers();
        $countBusiness = $this->countBusiness();
        $countProduct = $this->countProduct();
        $countAd = $this->countAd();
        $getProductCountsByType = $this->getProductCountsByType();
        $getBusinessCountsBySubDistrict = $this->getBusinessCountsBySubDistrict();

        return view('admin.dashboard', compact(
            'admin', 
            'countUnverifiedUsers', 
            'getUnverifiedUsers',
            'countBusiness',
            'countProduct',
            'countAd',
            'getProductCountsByType',
            'getBusinessCountsBySubDistrict'
        ));
    }

    private function getUnverifiedUsers() {
        return User::with('business')->where('verified_by', null)->get();
    }

    private function countUnverifiedUsers() {
        return User::where('verified_by', null)->count();
    }

    private function countBusiness() {
        return Business::whereHas('user', function($query) {
            $query->whereNotNull('verified_by')
                  ->whereNotNull('email_verified_at');
        })->count();
    }

    private function countProduct() {
        return Product::count();
    }

    private function countAd() {
        return Advertisement::count();
    }

    private function getProductCountsByType() {
        $products = Product::with('productType')->get(); 
        return $products->groupBy('productType.name')->map(function ($group) {
            return ['value' => $group->count(), 'name' => $group->first()->productType->name];
        })->values()->toArray();
    }

    private function getBusinessCountsBySubDistrict()
    {
        return Business::with('subDistrict')
            ->select('sub_district_id', DB::raw('count(*) as count'))
            ->groupBy('sub_district_id')
            ->get()
            ->map(function ($business) {
                return [
                    'name' => $business->subDistrict->name,
                    'value' => $business->count
                ];
            });
    }
}
