<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubDistrict;
use Illuminate\Http\Request;

class SubDistricController extends Controller
{
    public function index(){
        $subDistricts = SubDistrict::get();
        return view('admin.subDistrict.index', compact('subDistricts'));
    }
}
