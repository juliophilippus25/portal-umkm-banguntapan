<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationSuccessEmail;

class UserController extends Controller
{
    public function index(){
        $users = User::with(['business', 'admin'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.users.index', compact('users'));
    }

    public function verify($id)
    {
        if (!auth('admin')->check()) {
            toast('Anda harus login sebagai admin.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('admin.login');
        }

        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            toast('User sudah terverifikasi.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back();
        }

        // Generate password dari NIK dan phone
        $nik = $user->nik; // Pastikan kolom NIK sesuai dengan nama kolom di tabel Anda
        $phone = $user->phone; // Pastikan kolom phone sesuai dengan nama kolom di tabel Anda

        $user->password = Hash::make($this->generatePassword($nik, $phone));
        $user->email_verified_at = now();
        $user->verified_by = auth('admin')->user()->id;
        $user->save();

        Mail::to($user->email)->send(new VerificationSuccessEmail($user));

        toast('User berhasil diverifikasi.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->back();
    }

    private function generatePassword($nik, $phone){

        // Ambil 4 digit terakhir dari NIK
        $nikLastFour = substr($nik, -4);

        // Ambil 4 digit terakhir dari phone
        $phoneLastFour = substr($phone, -4);

        // Gabungkan keduanya
        return $nikLastFour . $phoneLastFour;
    }
}
