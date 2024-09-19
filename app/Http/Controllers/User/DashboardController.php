<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $userId = auth('user')->user()->id;
        return view('user.dashboard', compact('userId'));
    }
}
