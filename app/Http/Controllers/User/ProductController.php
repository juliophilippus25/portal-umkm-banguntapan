<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Business;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        // Mengambil user yang sedang login
        $authUserId = auth('user')->user()->id;
        // Mengambil ID dari bisnis
        $businessId = Business::where('user_id', $authUserId)->pluck('id')->first();
        
        // Mengambil produk sesuai dengan businessId
        $products = Product::with(['business', 'productType'])
        ->where('business_id', $businessId)
        ->orderBy('created_at', 'desc')
        ->get();
        
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
            'description' => 'required|string|min:3',
            'price' => 'required',
            'product_type_id' => 'required|exists:product_types,id',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',        
        ],
        // Pesan
        [
            // Required
            'name.required' => 'Nama produk harus diisi.',
            'description.required' => 'Description produk harus diisi.',
            'price.required' => 'Harga produk harus diisi.',
            'product_type_id.required' => 'Kategori Produk harus dipilih.',

            // Exists
            'product_type_id.exists' => 'Kategori Produk yang dipilih tidak valid.',
            
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

        $price = str_replace(['Rp ', '.', ','], '', $request->price);

        // dd($price);

        Product::create([
            'id' => $productId,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $price,
            'business_id' => $businessId,
            'product_type_id' => $request->product_type_id,
            'image' => $image
        ]);

        toast('Berhasil menambah produk.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->route('user.products');;
    }

    private function generateUniqueProductId($productTypeId){
        $prefix = 'PR';

        // Format ID Kategori Produk menjadi 2 digit
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

    public function edit($id){
        $product = Product::find($id);
        $product_types = ProductType::all();

        return view('user.products.edit', compact('product', 'product_types'));
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $validator = Validator::make($request->all(),
        // Aturan
        [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required',
            'product_type_id' => 'required|exists:product_types,id',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',        
        ],
        // Pesan
        [
            // Required
            'name.required' => 'Nama produk harus diisi.',
            'description.required' => 'Description produk harus diisi.',
            'price.required' => 'Harga produk harus diisi.',
            'product_type_id.required' => 'Kategori Produk harus dipilih.',

            // Min
            'name.min' => 'Nama produk harus memiliki setidaknya :min karakter.',
            'description.min' => 'Deskripsi produk harus memiliki setidaknya :min karakter.',

            // String
            'description.string' => 'Deskripi iklan harus berupa teks.',

            // Exists
            'product_type_id.exists' => 'Kategori Produk yang dipilih tidak valid.',
            
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

        $price = str_replace(['Rp ', '.', ','], '', $request->price);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $price;
        $product->product_type_id = $request->input('product_type_id');
        $product->image = $image;

        $product->update();

        toast('Berhasil mengubah produk.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->route('user.products');;
    }

    public function destroy($id) {
        $product = Product::find($id);

        if (!$product) {
            toast('Produk tidak ditemukan.','error')->timerProgressBar()->autoClose(5000);
            return redirect()->route('user.products');
        }

        if ($product->image && Storage::exists('images/products/' . $product->image)) {
            Storage::delete('images/products/' . $product->image);
        }

        $product->delete();

        toast('Berhasil menghapus produk.','success')->timerProgressBar()->autoClose(5000);
        return redirect()->route('user.products');
    }
}
