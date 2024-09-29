<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $user = auth('user')->user();
        return view('user.profile.user.index', compact('user'));
    }

    public function update(Request $request, $userId)
    {
        $userId = auth('user')->id();;
        $user = User::findOrFail($userId);

        $validator = Validator::make($request->all(), 
        // Aturan
        [
            // Data Pengguna
            'name' => 'required|string|min:3|unique:users,name,'.$user->id,
            'nik' => 'required|digits:16|unique:users,nik,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|digits_between:10,15|unique:users,phone,'.$user->id,

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

        $user->name = $request->input('name');
        $user->nik = $request->input('nik');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        if($request->input('password')) {
            $user->password= bcrypt(($request->input('password')));
        }

        // Proses upload avatar
        if($request->file('avatar')) {
            $oldImage = $user->avatar;
            $extension = $request->avatar->getClientOriginalExtension();
            $fileName = time() . '.' .$extension;
            $image = $request->file('avatar')->storeAs('images/users', $fileName);
            $user->avatar = $fileName;
            if ($oldImage) {
                Storage::delete('images/users/' . $oldImage);
            }
        }
        $user->update();

        toast('Berhasil mengubah profil.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->back();

    }
}
