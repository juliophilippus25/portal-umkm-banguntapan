<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationSuccessEmail;

class UserController extends Controller
{
    public function index(){
        $users = User::with('business')->get();

        return view('admin.users.index', compact('users'));
    }

    public function verify($id)
    {
        if (!auth('admin')->check()) {
            return redirect()->route('admin.login')->withErrors('Anda harus login sebagai admin.');
        }

        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            return redirect()->back()->withErrors('User sudah terverifikasi.');
        }
        $user->password = Hash::make('password');
        $user->email_verified_at = now();
        $user->verified_by = auth('admin')->user()->id;
        $user->save();

        Mail::to($user->email)->send(new VerificationSuccessEmail($user));

        return redirect()->back()->with('success', 'User berhasil diverifikasi.');
    }
}
