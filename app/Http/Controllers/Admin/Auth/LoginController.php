<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
        // Aturan
        [
            'username' => 'required',
            'password' => 'required|string|min:8'
        ],
        // Pesan
        [
            // Required
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Kata sandi tidak boleh kosong!',
            
            // Min
            'password.min' => 'Kata sandi minimal 8 karakter!',
        ]);

        if($validator->fails()){
            // redirect dengan pesan error
            toast('Periksa kembali data anda.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            toast('Anda berhasil masuk ke sistem.','success')->timerProgressBar()->autoClose(5000);
            return redirect()->intended(route('admin.dashboard'));
        } else {
            toast('Data anda tidak valid.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('admin.showLogin');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.showLogin');
    }
}
