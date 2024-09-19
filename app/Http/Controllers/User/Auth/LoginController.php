<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard()->attempt($credentials)) {
            toast('Anda berhasil masuk ke sistem.','success')->hideCloseButton()->autoClose(3000);
            return redirect()->intended(route('user.dashboard'));
        }

        return redirect('/login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect('/');
    }
}
