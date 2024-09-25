<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Business;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['business', 'productType'])->get();
        return view('user.products.index', compact('products'));
    }

    public function create(){
        $product_types = ProductType::all();

        return view('user.products.create', compact('product_types'));
    }

    public function store(Request $request){
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;

        // Jika ingin mengambil hanya ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();

        $productId = $this->generateUniqueProductId($request->product_type_id);

        $validator = Validator::make($request->all(),
        // Aturan
        [
            'name' => 'required|string|min:3',
            'product_type_id' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',        
        ],
        // Pesan
        [
            // Required
            'name.required' => 'Nama produk harus diisi.',
            'product_type_id.required' => 'Jenis produk harus dipilih.',
            
            // Mimes
            'image.mimes' => 'Gambar harus berupa file dengan format: jpg, jpeg, png.',
            
            // Max
            'image.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
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
            $image = $request->file('image')->storeAs('images/products', $fileName);
            $image = $fileName;
        } else {
            $image = NULL;
        }

        Product::create([
            'id' => $productId,
            'name' => $request->name,
            'business_id' => $businessId,
            'product_type_id' => $request->product_type_id,
            'price' => $request->price,
            'image' => $image
        ]);

        toast('Berhasil menambah produk.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->route('user.products');;
    }

    private function generateUniqueProductId($productTypeId){
        $prefix = 'PR';

        // Format ID jenis produk menjadi 2 digit
        $formattedProductTypeId = str_pad($productTypeId, 2, '0', STR_PAD_LEFT);

        // Ambil produk terakhir untuk menghasilkan nomor unik
        $lastProduct = Product::where('id', 'like', $prefix . $formattedProductTypeId . '%') // Sesuaikan format
            ->orderBy('id', 'desc')
            ->first();

        if ($lastProduct) {
            // Ambil angka terakhir dari ID produk
            $lastNumber = (int)substr($lastProduct->id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001'; // Mulai dari 0001 jika belum ada produk
        }

        return $prefix . $formattedProductTypeId . $newNumber; // Contoh format: PR010001, PR020001
    }
}
