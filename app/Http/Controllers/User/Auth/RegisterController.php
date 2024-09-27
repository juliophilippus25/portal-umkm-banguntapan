<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use App\Models\Business;
use App\Models\SubDistrict;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        $business_types = BusinessType::all();
        $sub_districts = SubDistrict::all();

        return view('user.auth.register', compact('business_types', 'sub_districts'));
    }

    public function register(Request $request){
        $userId = $this->generateUniqueUserId();
        $businessId = $this->generateUniqueBusinessId();

        $validator = Validator::make($request->all(),
        // Aturan
        [
            // Data Pengguna
            'name' => 'required|string|min:3',
            'phone' => 'required|digits_between:10,15',
            'nik' => 'required|digits:16|unique:users,nik',
            'email' => 'required|email|unique:users,email',

            // Data UMKM
            'business_name' => 'required|string|min:3',
            'business_description' => 'required|string|min:3',
            'business_type_id' => 'required',
            'sub_district_id' => 'required',
            'business_phone' => 'required|digits_between:10,15',
            'website' => 'nullable|url',
            'no_pirt' => 'nullable',
            'address' => 'required|string',
            'zip_code' => 'required|digits:5',
        ],
        // Pesan
        [
            // Required
            'name.required' => 'Nama lengkap harus diisi.',
            'phone.required' => 'Nomor HP harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'email.required' => 'Email harus diisi.',
            'business_name.required' => 'Nama usaha harus diisi.',
            'business_description.required' => 'Deskripsi usaha harus diisi.',
            'business_type_id.required' => 'Kategori Usaha harus dipilih.',
            'business_phone.required' => 'Nomor HP usaha harus diisi.',
            'sub_district_id.required' => 'Kalurahan harus dipilih.',
            'address.required' => 'Alamat harus diisi.',
            'zip_code.required' => 'Kode pos harus diisi.',

            // Email
            'email.email' => 'Format email salah.',

            // Unique
            'phone.unique' => 'Nomor HP sudah terdaftar.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',

            // String
            'business_name.string' => 'Nama usaha harus berupa teks.',
            'business_description.string' => 'Deskripi usaha harus berupa teks.',
            'address.string' => 'Alamat harus berupa teks.',
            
            // Min
            'name.min' => 'Nama lengkap harus memiliki setidaknya :min karakter.',
            'business_name.min' => 'Nama usaha harus memiliki setidaknya :min karakter.',
            'business_description.min' => 'Deskripsi usaha harus memiliki setidaknya :min karakter.',

            // Digits_beetween
            'phone.digits_between' => 'Nomor HP harus antara :min hingga :max karakter.',
            'business_phone.digits_between' => 'Nomor HP harus antara :min hingga :max karakter.',

            // Digits
            'nik.digits' => 'NIK harus tepat :digits karakter.',
            'zip_code.digits' => 'Kode pos harus tepat :digits karakter.',

            // URL
            'website.url' => 'URL/Link tidak valid. Contoh: http://example.com'
        ]);

        if($validator->fails()){
            // redirect dengan pesan error
            toast('Periksa kembali data anda.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'id' => $userId,
            'name' => $request->name,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'email' => $request->email
        ]);

        $business = Business::create([
            'id' => $businessId,
            'user_id' => $userId,
            'business_name' => $request->business_name,
            'business_description' => $request->business_description,
            'business_type_id' => $request->business_type_id,
            'sub_district_id' => $request->sub_district_id,
            'business_phone' => $request->business_phone,
            'website' => $request->website,
            'no_pirt' => $request->no_pirt,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
        ]);

        $details = [
            'name' => $user['name'],
            'email' =>$user['email'],
            'business_name' => $business['business_name']
        ];

        // Mail::to('admin@umkmbanguntapan.com')->send(new VerificationEmail($details));
        
        toast('Berhasil mendaftar. Silakan menunggu verifikasi melalui email anda.','success')->hideCloseButton()->autoClose(5000);
        return redirect()->route('user.showRegister');
    }

    private function generateUniqueUserId()
    {
        $prefix = 'USER';

        $lastUser = User::where('id', 'like', '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastUser) {
            $lastNumber = (int)substr($lastUser->id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $newNumber;
    }

    private function generateUniqueBusinessId()
    {
        $prefix = 'UMKM';
        $lastBusiness = Business::where('id', 'like','%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastBusiness) {
            $lastNumber = (int)substr($lastBusiness->id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $newNumber;
    }
}
