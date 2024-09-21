<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
        // Aturan
        [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ],
        // Pesan
        [
            // Required
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Kata sandi harus diisi.',
            
            // Email
            'email.email' => 'Format email salah!',
            
            // Min
            'password.min' => 'Kata sandi harus memiliki setidaknya :min karakter.!',
        ]);

        if($validator->fails()){
            // redirect dengan pesan error
            toast('Periksa kembali data anda.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            toast('Anda berhasil masuk ke sistem.','success')->timerProgressBar()->autoClose(5000);
            return redirect()->intended(route('user.dashboard'));
        } else {
            toast('Data anda tidak valid.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.showLogin');
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.showLogin');
    }
}
