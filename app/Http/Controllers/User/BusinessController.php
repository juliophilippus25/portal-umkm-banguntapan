<?php

namespace App\Http\Controllers\User;

use App\Models\Business;
use App\Models\SubDistrict;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index(){
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        $business_types = BusinessType::all();
        $sub_districts = SubDistrict::all();

        // Mengambil bisnis dengan relasi businessType dan subDistrict
        $business = Business::with(['businessType', 'subDistrict'])
                            ->where('user_id', $authUserId)
                            ->first();

        return view('user.profile.business.index', compact('business', 'business_types', 'sub_districts'));
    }

    public function update(Request $request, $businessId)
    {
        $userId = auth('user')->id();
        $business = Business::where('id', $businessId)
                ->where('user_id', $userId)
                ->firstOrFail();

        $validator = Validator::make($request->all(), 
        // Aturan
        [
            // Data UMKM
            'business_name' => 'required|string|min:3|unique:businesses,business_name,'.$business->id,
            'business_description' => 'required|string|min:3',
            'business_type_id' => 'required',
            'sub_district_id' => 'required',
            'business_phone' => 'required|digits_between:10,15|unique:businesses,business_phone,'.$business->id,
            'website' => 'nullable|url',
            'no_pirt' => 'nullable',
            'address' => 'required|string',
            'zip_code' => 'required|digits:5',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ],
        // Pesan
        [
            // Required
            'business_name.required' => 'Nama usaha harus diisi.',
            'business_description.required' => 'Deskripsi usaha harus diisi.',
            'business_type_id.required' => 'Kategori Usaha harus dipilih.',
            'business_phone.required' => 'Nomor HP usaha harus diisi.',
            'sub_district_id.required' => 'Kalurahan harus dipilih.',
            'address.required' => 'Alamat harus diisi.',
            'zip_code.required' => 'Kode pos harus diisi.',

            
            // Unique
            'business_name.unique' => 'Nama usaha sudah terdaftar.',
            'business_phone.unique' => 'Nomor HP usaha sudah terdaftar.',

            // String
            'business_name.string' => 'Nama usaha harus berupa teks.',
            'business_description.string' => 'Deskripi usaha harus berupa teks.',
            'address.string' => 'Alamat harus berupa teks.',

            // Min
            'business_name.min' => 'Nama usaha harus memiliki setidaknya :min karakter.',
            'business_description.min' => 'Deskripsi usaha harus memiliki setidaknya :min karakter.',

            // Digits_beetween
            'phone.digits_between' => 'Nomor HP harus antara :min hingga :max karakter.',
            'business_phone.digits_between' => 'Nomor HP harus antara :min hingga :max karakter.',

            // Digits
            'nik.digits' => 'NIK harus tepat :digits karakter.',
            'zip_code.digits' => 'Kode pos harus tepat :digits karakter.',

            // URL
            'website.url' => 'URL/Link tidak valid. Contoh: http://example.com',
            
            // Mimes
            'image.mimes' => 'Foto profil harus berupa file JPG, JPEG, atau PNG.',
            'image.max' => 'Ukuran foto profil maksimal 2MB.'
            ]
        );

        if($validator->fails()){
            // redirect dengan pesan error
            toast('Periksa kembali data anda.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $business->business_name = $request->input('business_name');
        $business->business_description = $request->input('business_description');
        $business->business_type_id = $request->input('business_type_id');
        $business->sub_district_id = $request->input('sub_district_id');
        $business->address = $request->input('address');
        $business->zip_code = $request->input('zip_code');
        $business->business_phone = $request->input('business_phone');
        $business->no_pirt = $request->input('no_pirt');
        $business->website = $request->input('website');

        // Proses upload image
        if($request->file('avatar')) {
            $oldImage = $business->avatar;
            $extension = $request->avatar->getClientOriginalExtension();
            $fileName = time() . '.' .$extension;
            $image = $request->file('avatar')->storeAs('images/businesses', $fileName);
            $business->avatar = $fileName;
            if ($oldImage) {
                Storage::delete('images/businesses/' . $oldImage);
            }
        }
        $business->update();

        toast('Berhasil mengubah profil.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->back();
    }
}
