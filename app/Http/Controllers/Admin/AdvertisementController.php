<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index(){
        $advertisements = Advertisement::with('business')->orderBy('created_at', 'desc')->get();
        
        return view('admin.advertisements.index', compact('advertisements'));
    }
}
