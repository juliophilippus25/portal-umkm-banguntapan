@extends('layouts.app')

@section('title', 'Profil UMKM')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            {{-- <h1>Manajemen Pengguna</h1> --}}
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Profil UMKM</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ($business->avatar)
                                <img src="{{ asset('storage/images/businesses/' . $business->avatar) }}" alt="Profile"
                                    class="rounded-circle" width="130px" height="130px" />
                            @elseif ($business->image === null)
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Profile" class="rounded-circle"
                                    width="130px" height="130px" />
                            @endif
                            <h2>{{ $business->business_name }}</h2>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <div class="profile-edit">
                                <form action="{{ route('user.profile.business.update', $business->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto
                                            Profil UMKM</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="mb-2">
                                                <small class="text-muted"><em>Unggah foto dengan format jpg/jpeg/png dan
                                                        maksimal ukuran foto 2mb</em></small>
                                            </div>
                                            @if ($business->avatar)
                                                <img id="preview"
                                                    src="{{ asset('storage/images/businesses/' . $business->avatar) }}"
                                                    width="150px" height="150px" />
                                            @else
                                                <img id="preview" src="{{ asset('images/default-image.jpg') }}"
                                                    width="150px" height="150px" />
                                            @endif
                                            <div class="mt-3">
                                                <div class="input-group">
                                                    <input class="form-control @error('avatar') is-invalid @enderror"
                                                        type="file" id="imgInp" name="avatar" accept="image/*">
                                                </div>
                                                @error('avatar')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="business_name" class="col-md-4 col-lg-3 col-form-label">Nama
                                            UMKM</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="business_name" type="text"
                                                class="form-control @error('business_name') is-invalid @enderror @if (old('business_name') && !$errors->has('business_name')) is-valid @endif"
                                                id="business_name"
                                                value="{{ old('business_name', $business->business_name) }}"
                                                placeholder="Masukkan nama usaha anda">
                                            @error('business_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="business_description" class="col-md-4 col-lg-3 col-form-label">Deskripsi
                                            Usaha</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="business_description" cols="30" rows="3"
                                                class="form-control @error('business_description') is-invalid @enderror @if (old('business_description') && !$errors->has('business_description')) is-valid @endif"
                                                id="business_description" placeholder="Masukkan deskripsi produk anda">{{ old('business_description', $business->business_description) }}</textarea>
                                            @error('business_description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="business_type_id" class="col-md-4 col-lg-3 col-form-label">Kategori
                                            Usaha</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select
                                                class="form-select @error('business_type_id') is-invalid @enderror @if (old('business_type_id') && !$errors->has('business_type_id')) is-valid @endif"
                                                name="business_type_id" id="business_type_id">
                                                <option hidden disabled selected value>Pilih kategori usaha anda</option>
                                                @foreach ($business_types as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('business_type_id', $business->business_type_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="sub_district_id"
                                            class="col-md-4 col-lg-3 col-form-label">Kalurahan</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select
                                                class="form-select @error('sub_district_id') is-invalid @enderror @if (old('sub_district_id') && !$errors->has('sub_district_id')) is-valid @endif"
                                                name="sub_district_id" id="sub_district_id">
                                                <option hidden disabled selected value>Pilih kalurahan usaha anda</option>
                                                @foreach ($sub_districts as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('sub_district_id', $business->sub_district_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Alamat Usaha</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text"
                                                class="form-control @error('address') is-invalid @enderror @if (old('address') && !$errors->has('address')) is-valid @endif"
                                                id="address" value="{{ old('address', $business->address) }}"
                                                placeholder="Masukkan alamat usaha anda">
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="zip_code" class="col-md-4 col-lg-3 col-form-label">Kode Pos</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="zip_code" type="text"
                                                class="form-control @error('zip_code') is-invalid @enderror @if (old('zip_code') && !$errors->has('zip_code')) is-valid @endif"
                                                id="zip_code" value="{{ old('zip_code', $business->zip_code) }}"
                                                onkeypress="return isNumberKey(event)"
                                                placeholder="Masukkan kode pos usaha anda">
                                            @error('zip_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="business_phone" class="col-md-4 col-lg-3 col-form-label">Nomor
                                            HP</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="business_phone" type="text"
                                                class="form-control @error('business_phone') is-invalid @enderror @if (old('business_phone') && !$errors->has('business_phone')) is-valid @endif"
                                                id="business_phone"
                                                value="{{ old('business_phone', $business->business_phone) }}"
                                                onkeypress="return isNumberKey(event)"
                                                placeholder="Masukkan nomor HP usaha anda">
                                            @error('business_phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="no_pirt" class="col-md-4 col-lg-3 col-form-label">Nomor Sertifikat
                                            PIRT</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="no_pirt" type="text"
                                                class="form-control @error('no_pirt') is-invalid @enderror @if (old('no_pirt') && !$errors->has('no_pirt')) is-valid @endif"
                                                id="no_pirt" value="{{ old('no_pirt', $business->no_pirt) }}"
                                                placeholder="Masukkan nomor sertifikat PIRT usaha anda">
                                            @error('no_pirt')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="website" class="col-md-4 col-lg-3 col-form-label">Website</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="website" type="url"
                                                class="form-control @error('website') is-invalid @enderror @if (old('website') && !$errors->has('website')) is-valid @endif"
                                                id="website" value="{{ old('website', $business->website) }}"
                                                placeholder="Contoh: https://www.example.com">
                                            @error('website')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div>
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

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
@endsection

@endsection
