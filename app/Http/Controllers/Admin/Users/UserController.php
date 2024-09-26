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
        $nik = $user->nik;
        $phone = $user->phone;

        $user->password = Hash::make($this->generatePassword($nik, $phone));
        $user->email_verified_at = now();
        $user->verified_by = auth('admin')->user()->id;
        $user->isActive = 1;
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

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);

        // Toggle status isActive
        $user->isActive = !$user->isActive;
        $user->save();

        $status = $user->isActive ? 'diaktifkan' : 'dinonaktifkan';
        toast("Akun berhasil $status.", 'success')->timerProgressBar()->autoClose(5000);

        return redirect()->back();
    }
}
