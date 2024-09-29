<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $admin = auth('admin')->user();
        return view('admin.profile.index', compact('admin'));
    }

    public function update(Request $request, $adminId)
    {
        $adminId = auth('admin')->id();;
        $admin = Admin::findOrFail($adminId);

        $validator = Validator::make($request->all(), 
        // Aturan
        [
            // Data Admin
            'name' => 'required|string|min:3|unique:admins,name,'.$admin->id,
            'username' => 'required|string|min:3|unique:admins,username,'.$admin->id,

            // Password
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8|same:password',

            // Avatar
            'avatar' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ],
        // Pesan
        [
            // Required
            'name.required' => 'Nama lengkap harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'email.required' => 'Email harus diisi.',
            'phone.required' => 'Nomor HP harus diisi.',
            'password.required' => 'Password harus diisi.',
            
            // Unique
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.unique' => 'Nomor HP sudah terdaftar.',

            // String
            'name.string' => 'Nama lengkap harus berupa teks.',
            
            // Email
            'email.email' => 'Format email salah.',

            // Min
            'name.min' => 'Nama lengkap harus memiliki setidaknya :min karakter.',
            'password.min' => 'Kata sandi harus memiliki setidaknya :min karakter.',
            'password_confirmation.min' => 'Konfirmasi kata sandi harus memiliki setidaknya :min karakter.',

            // Digits
            'nik.digits' => 'NIK harus tepat :digits karakter.',
            'phone.digits_between' => 'Nomor HP harus antara :min hingga :max karakter.',

            // Confirmed
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password_confirmation.same' => 'Konfirmasi kata sandi harus sama dengan kata sandi baru.',
            
            // Mimes
            'avatar.mimes' => 'Foto profil harus berupa file JPG, JPEG, atau PNG.',
            'avatar.max' => 'Ukuran foto profil maksimal 2MB.'
            ]
        );

        if($validator->fails()){
            // redirect dengan pesan error
            toast('Periksa kembali data anda.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin->name = $request->input('name');
        $admin->username = $request->input('username');
        if($request->input('password')) {
            $admin->password= bcrypt(($request->input('password')));
        }

        // Proses upload avatar
        if($request->file('avatar')) {
            $oldImage = $admin->avatar;
            $extension = $request->avatar->getClientOriginalExtension();
            $fileName = time() . '.' .$extension;
            $image = $request->file('avatar')->storeAs('images/admins', $fileName);
            $admin->avatar = $fileName;
            if ($oldImage) {
                Storage::delete('images/admins/' . $oldImage);
            }
        }
        $admin->update();

        toast('Berhasil mengubah profil.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->back();
    }
}
