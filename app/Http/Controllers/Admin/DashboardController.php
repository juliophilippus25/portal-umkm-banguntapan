<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $admin = Auth::guard('admin')->user();
        $countUnverifiedUsers = $this->countUnverifiedUsers();
        $getUnverifiedUsers = $this->getUnverifiedUsers();
        return view('admin.dashboard', compact('admin', 'countUnverifiedUsers', 'getUnverifiedUsers'));
    }

    private function getUnverifiedUsers() {
        return User::with('business')->where('verified_by', null)->get();
    }

    private function countUnverifiedUsers() {
        return User::where('verified_by', null)->count();
    }
}
