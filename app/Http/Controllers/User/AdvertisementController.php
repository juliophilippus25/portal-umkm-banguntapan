<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Business;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use App\Models\AdvertisementProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    public function index(){
        $now = now();
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        // Mengambil ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();

        // Mengambil iklan sesuai dengan businessId
        $advertisements = Advertisement::with(['business', 'products'])
            ->where('business_id', $businessId)
            ->get();
            
        return view('user.advertisements.index', compact('advertisements', 'now'));
    }

    public function create(){
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        // Mengambil ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();

        // Mengambil produk sesuai dengan businessId
        $products = Product::with(['business', 'productType'])
            ->where('business_id', $businessId)
            ->get();

        return view('user.advertisements.create', compact('products'));
    }

    public function store(Request $request){
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        // Mengambil ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();

        $advertisementId = $this->generateUniqueAdvertisementId();

        $validator = Validator::make($request->all(), 
        // Aturan
        [
            'name' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id', // Validasi setiap id produk
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'ad_start' => 'required|date|after_or_equal:' . now()->format('Y-m-d'), // Validasi untuk ad_start
            'ad_end' => 'required|date|after:ad_start', // Validasi untuk ad_end
        ], 
        // Pesan
        [
            // Required
            'name.required' => 'Nama iklan harus diisi.',
            'product_id.required' => 'Produk harus dipilih.',
            'ad_start.required' => 'Tanggal mulai iklan harus diisi.',
            'ad_end.required' => 'Tanggal berakhir iklan harus diisi.',

            // Mimes
            'image.mimes' => 'Gambar harus berupa file dengan format: jpg, jpeg, png.',

            // Max
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',

            // Date
            'ad_start.date' => 'Tanggal mulai iklan harus berupa tanggal yang valid.',
            'ad_start.after_or_equal' => 'Tanggal mulai iklan tidak boleh sebelum hari ini.',
            'ad_end.date' => 'Tanggal berakhir iklan harus berupa tanggal yang valid.',
            'ad_end.after' => 'Tanggal berakhir iklan harus setelah tanggal mulai iklan.',
        ]);

        if($validator->fails()){
            // redirect dengan pesan error
            toast('Periksa kembali data anda.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses upload image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->image->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $image = $request->file('image')->storeAs('images/advertisements', $fileName);
            $image = $fileName;
        } else {
            $image = NULL;
        }

        // Simpan data iklan hanya sekali dengan informasi produk yang terkait
        $advertisement = Advertisement::create([
            'id' => $advertisementId,
            'name' => $request->name,
            'ad_start' => $request->ad_start,
            'ad_end' => $request->ad_end,
            'business_id' => $businessId,
            'image' => $image,
        ]);

        // Simpan relasi produk dan iklan
        foreach ($request->product_id as $productId) {
            AdvertisementProduct::create([
                'advertisement_id' => $advertisement->id,
                'product_id' => $productId,
            ]);
        }

        toast('Berhasil menambah iklan.', 'success')->timerProgressBar()->autoClose(5000);
        return redirect()->route('user.advertisements');
    }

    private function generateUniqueAdvertisementId()
    {
        $prefix = 'ADSB';

        // Mengambil ID terakhir yang memiliki prefix tertentu
        $lastAdvertisement = Advertisement::where('id', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastAdvertisement) {
            $lastNumber = (int)substr($lastAdvertisement->id, strlen($prefix));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001'; // Jika tidak ada, mulai dari 0001
        }

        return $prefix . $newNumber; // Mengembalikan ID baru
    }

    public function destroy($id) {
        $advertisement = Advertisement::find($id);

        if (!$advertisement) {
            toast('Produk tidak ditemukan.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.advertisements');
        }

        if ($advertisement->image && Storage::exists('images/advertisements/' . $advertisement->image)) {
            Storage::delete('images/advertisements/' . $advertisement->image);
        }

        $advertisement->delete();

        toast('Berhasil menghapus iklan.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->route('user.advertisements');
    }
}
