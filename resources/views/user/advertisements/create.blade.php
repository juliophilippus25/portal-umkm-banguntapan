@extends('layouts.app')

@section('title', 'Iklan')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Iklan</li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Iklan</h5>
                        <form action="{{ route('user.advertisements.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="name" class="form-label">Nama Iklan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror @if (old('name') && !$errors->has('name')) is-valid @endif"
                                            id="name" placeholder="Masukkan nama iklan anda"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="description" class="form-label">Deskripsi Iklan</label>
                                        <textarea name="description" cols="30" rows="3"
                                            class="form-control @error('description') is-invalid @enderror @if (old('description') && !$errors->has('description')) is-valid @endif"
                                            id="description" placeholder="Masukkan deskripsi iklan anda">{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="ad_start" class="form-label">Tanggal Mulai Iklan <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="ad_start"
                                            class="form-control @error('ad_start') is-invalid @enderror @if (old('ad_start') && !$errors->has('ad_start')) is-valid @endif"
                                            id="ad_start" placeholder="Masukkan nama iklan anda"
                                            value="{{ old('ad_start') }}" required>
                                        @error('ad_start')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="ad_end" class="form-label">Tanggal Berakhir Iklan <span
                                                class="text-danger">*</span></label>
                                        <input type="date" name="ad_end"
                                            class="form-control @error('ad_end') is-invalid @enderror @if (old('ad_end') && !$errors->has('ad_end')) is-valid @endif"
                                            id="ad_end" placeholder="Masukkan nama iklan anda"
                                            value="{{ old('ad_end') }}" required>
                                        @error('ad_end')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="product_id" class="form-label">Produk <span
                                                class="text-danger">*</span></label>
                                        <small class="text-muted"><em>Gunakan CTRL+Klik untuk menambahkan/menghapus
                                                produk</em></small>
                                        <select multiple
                                            class="form-select @error('product_id') is-invalid @enderror @if (old('product_id') && !$errors->has('product_id')) is-valid @endif"
                                            name="product_id[]" id="product_id">
                                            <option hidden disabled selected value>Pilih produk anda</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    data-type="{{ $product->productType->name }}"
                                                    data-price="{{ $product->price }}"
                                                    {{ is_array(old('product_id')) && in_array($product->id, old('product_id')) ? 'selected' : '' }}>
                                                    {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <!-- Tabel untuk menampilkan produk yang dipilih -->
                                    <div class="mb-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-3">Kode Produk</th>
                                                    <th class="col-3">Nama</th>
                                                    <th class="col-3">Harga</th>
                                                    <th class="col-3">Kategori Produk</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selectedProducts">
                                                <!-- Produk yang dipilih akan ditambahkan di sini -->
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada produk yang dipilih.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label>Gambar</label>
                                        <small class="text-muted"><em>Unggah gambar dengan format jpg/jpeg/png dan
                                                maksimal ukuran gambar 2mb</em></small>
                                        <div class="col-md-12">
                                            <img id="preview" class="mt-2" width="150" height="150" />
                                            <div class="input-group my-3">
                                                <input class="form-control @error('image') is-invalid @enderror"
                                                    type="file" id="imgInp" name="image" accept="image/*">
                                            </div>
                                        </div>
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('user.advertisements') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

    </main><!-- End #main -->
@section('script')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        function formatIDR(amount) {
            return 'Rp ' + Number(amount).toLocaleString('id-ID');
        }
        // Update tabel saat produk dipilih
        document.getElementById('product_id').addEventListener('change', function() {
            const selectedOptions = Array.from(this.selectedOptions);
            const selectedProductsContainer = document.getElementById('selectedProducts');

            selectedProductsContainer.innerHTML = '';

            if (selectedOptions.length === 0) {
                selectedProductsContainer.innerHTML =
                    '<tr><td colspan="4" class="text-center">Tidak ada produk yang dipilih.</td></tr>';
                return;
            }

            selectedOptions.forEach(option => {
                const productId = option.value;
                const productName = option.text;
                const productPrice = option.getAttribute(
                    'data-price'); // Ambil harga produk dari data attribute
                const productTypeName = option.getAttribute(
                    'data-type'); // Ambil Kategori Produk dari data attribute

                const row = document.createElement('tr');
                row.innerHTML =
                    `<td>${productId}</td><td>${productName}</td><td>${formatIDR(productPrice)}</td><td>${productTypeName}</td>`;
                selectedProductsContainer.appendChild(row);
            });
        });
    </script>
@endsection
@endsection
