@extends('landing-page.layouts.app')

@section('title', '| Registrasi')

@section('body-class', 'starter-page-page')

@section('content')


    <!-- Hero Section -->
    <section class="section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Registrasi Pelaku Usaha</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10">
                    <div class="card shadow-md rounded-lg" data-aos="fade-up" data-aos-delay="200">
                        <form action="{{ route('user.register') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <!-- Data Penanggung Jawab -->
                                <div class="form-group mb-4">
                                    <h6 class="text-dark font-weight-bolder"><strong>Data Penanggung Jawab</strong></h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="name" class="form-label">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="Masukkan nama lengkap anda" value="{{ old('name') }}"
                                                required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="phone" class="form-label">Nomor HP <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" inputmode="numeric" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                placeholder="Masukkan nomor HP anda" value="{{ old('phone') }}"
                                                onkeypress="return isNumberKey(event)" required>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="nik" class="form-label">NIK <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" inputmode="numeric" name="nik"
                                                class="form-control @error('nik') is-invalid @enderror" id="nik"
                                                placeholder="Masukkan NIK anda" value="{{ old('nik') }}"
                                                onkeypress="return isNumberKey(event)" required>
                                            @error('nik')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="email" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                placeholder="Masukkan email anda" value="{{ old('email') }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Data UMKM -->
                                <div class="form-group mb-4">
                                    <h6 class="text-dark font-weight-bolder"><strong>Data UMKM</strong></h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="business_name" class="form-label">Nama Usaha <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="business_name"
                                                class="form-control @error('business_name') is-invalid @enderror"
                                                id="business_name" placeholder="Masukkan nama usaha anda"
                                                value="{{ old('business_name') }}" required>
                                            @error('business_name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="business_description" class="form-label">Deskripsi Usaha <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="business_description" cols="30" rows="3"
                                                class="form-control @error('business_description') is-invalid @enderror" id="business_description"
                                                placeholder="Masukkan deskripsi usaha anda" required>{{ old('business_description') }}</textarea>
                                            @error('business_description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="business_type_id" class="form-label">Kategori Usaha <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('business_type_id') is-invalid @enderror"
                                                name="business_type_id" id="business_type_id" required>
                                                <option hidden disabled selected value>Pilih kategori usaha anda</option>
                                                @foreach ($business_types as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('business_type_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('business_type_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="sub_district_id" class="form-label">Kalurahan <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('sub_district_id') is-invalid @enderror"
                                                name="sub_district_id" id="sub_district_id" required>
                                                <option hidden disabled selected value>Pilih kalurahan usaha anda</option>
                                                @foreach ($sub_districts as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('sub_district_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('sub_district_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="address" class="form-label">Alamat Usaha <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror" id="address"
                                                placeholder="Masukkan alamat usaha anda" value="{{ old('address') }}"
                                                required>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="zip_code" class="form-label">Kode Pos <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" inputmode="numeric" name="zip_code"
                                                class="form-control @error('zip_code') is-invalid @enderror"
                                                id="zip_code" placeholder="Masukkan kode pos usaha anda"
                                                value="{{ old('zip_code') }}" onkeypress="return isNumberKey(event)"
                                                required>
                                            @error('zip_code')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="business_phone" class="form-label">Nomor HP Usaha <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" inputmode="numeric" name="business_phone"
                                                class="form-control @error('business_phone') is-invalid @enderror"
                                                id="business_phone" placeholder="Masukkan nomor HP usaha anda"
                                                value="{{ old('business_phone') }}"
                                                onkeypress="return isNumberKey(event)" required>
                                            @error('business_phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="no_pirt" class="form-label">Nomor Sertifikat PIRT</label>
                                            <input type="text" name="no_pirt"
                                                class="form-control @error('no_pirt') is-invalid @enderror"
                                                id="no_pirt" placeholder="Masukkan nomor sertifikat PIRT usaha anda"
                                                value="{{ old('no_pirt') }}">
                                            @error('no_pirt')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-3">
                                            <label for="website" class="form-label">Website</label>
                                            <input type="url" name="website"
                                                class="form-control @error('website') is-invalid @enderror"
                                                id="website" placeholder="Contoh: https://www.example.com"
                                                value="{{ old('website') }}">
                                            @error('website')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-custom col-6 mt-3" type="submit">Registrasi</button>
                                    <div class="mt-3">
                                        <a href="{{ route('user.showLogin') }}" class="text-decoration-none">Sudah punya
                                            akun? Login disini</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
