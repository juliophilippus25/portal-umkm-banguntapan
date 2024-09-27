@extends('layouts.app')

@section('title', 'Produk')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Produk</li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Produk</h5>
                        <form action="{{ route('user.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="name" class="form-label">Nama Produk <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror @if (old('name') && !$errors->has('name')) is-valid @endif"
                                            id="name" placeholder="Masukkan nama produk anda"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="description" class="form-label">Deskripsi Produk
                                            <span class="text-danger">*</span></label>
                                        <textarea name="description" cols="30" rows="3"
                                            class="form-control @error('description') is-invalid @enderror @if (old('description') && !$errors->has('description')) is-valid @endif"
                                            id="description" placeholder="Masukkan deskripsi produk anda" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="price" class="form-label">Harga Produk <span
                                                class="text-danger">*</span></label>
                                        <input type="text" inputmode="numeric" name="price"
                                            class="form-control @error('price') is-invalid @enderror @if (old('price') && !$errors->has('price')) is-valid @endif"
                                            id="price" placeholder="Masukkan harga produk anda"
                                            oninput="formatCurrency(this)" onkeypress="return isNumberKey(event)"
                                            value="{{ old('price') }}" required>
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                        <label for="product_type_id" class="form-label">Kategori Produk <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="form-select @error('product_type_id') is-invalid @enderror @if (old('product_type_id') && !$errors->has('product_type_id')) is-valid @endif"
                                            name="product_type_id" id="product_type_id">
                                            <option hidden disabled selected value>Pilih Kategori Produk anda</option>
                                            @foreach ($product_types as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('product_type_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                                <a href="{{ route('user.products') }}" class="btn btn-secondary">Kembali</a>
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
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        function formatCurrency(input) {
            // Hapus karakter yang bukan angka
            let value = input.value.replace(/[^0-9]/g, '');

            // Format dengan titik
            value = parseInt(value).toLocaleString('id-ID');

            // Tambahkan prefix "Rp "
            input.value = value ? 'Rp ' + value : '';
        }
    </script>
@endsection
@endsection
