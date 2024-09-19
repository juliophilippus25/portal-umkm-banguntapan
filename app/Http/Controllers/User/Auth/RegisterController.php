<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessType;
use App\Models\SubDistrict;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        $business_types = BusinessType::all();
        $sub_districts = SubDistrict::all();
        $userId = $this->generateUniqueUserId();
        $businessId = $this->generateUniqueBusinessId();
        return view('user.auth.register', compact('business_types', 'sub_districts', 'userId', 'businessId'));
    }

    public function register(Request $request){
        $userId = $this->generateUniqueUserId();
        $businessId = $this->generateUniqueBusinessId();

        User::create([
            'id' => $userId,
            'name' => $request->name,
            'phone' => $request->phone,
            'nik' => $request->nik,
            'email' => $request->email
        ]);

        Business::create([
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

        toast('Berhasil mendaftar!.','success')->hideCloseButton()->autoClose(3000);
        return redirect('/register');
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
