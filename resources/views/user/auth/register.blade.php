<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ env('APP_NAME') }} | Registrasi </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('NiceAdmin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('NiceAdmin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('NiceAdmin/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>

        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-10 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <span class="h4">Registrasi Akun</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card shadow-lg col-lg-12 col-md-12">
                            <div class="card-body pt-3">
                                <form action="{{ route('user.register') }}" method="POST">
                                    @csrf

                                    <div class="form-group mt-2">
                                        <h5 class="text-dark font-weight-bolder">Data Penanggung Jawab</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="name" class="form-label">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror @if (old('name') && !$errors->has('name')) is-valid @endif"
                                                    id="name" placeholder="Masukkan nama lengkap anda"
                                                    value="{{ old('name') }}" required>
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="phone" class="form-label">Nomor HP <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" inputmode="numeric" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror @if (old('phone') && !$errors->has('phone')) is-valid @endif"
                                                    id="phone" placeholder="Masukkan nomor HP anda"
                                                    value="{{ old('phone') }}" onkeypress="return isNumberKey(event)"
                                                    required>
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="nik" class="form-label">NIK <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" inputmode="numeric" name="nik"
                                                    class="form-control @error('nik') is-invalid @enderror @if (old('nik') && !$errors->has('nik')) is-valid @endif"
                                                    id="nik" placeholder="Masukkan NIK anda"
                                                    onkeypress="return isNumberKey(event)" value="{{ old('nik') }}"
                                                    required>
                                                @error('nik')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="email" class="form-label">Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror @if (old('email') && !$errors->has('email')) is-valid @endif"
                                                    id="email" placeholder="Masukkan email anda"
                                                    value="{{ old('email') }}" required>
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <h5 class="text-dark font-weight-bolder">Data UMKM</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="business_name" class="form-label">Nama Usaha <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="business_name"
                                                    class="form-control @error('business_name') is-invalid @enderror @if (old('business_name') && !$errors->has('business_name')) is-valid @endif"
                                                    id="business_name" placeholder="Masukkan nama usaha anda"
                                                    value="{{ old('business_name') }}" required>
                                                @error('business_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="business_description" class="form-label">Deskripsi Usaha
                                                    <span class="text-danger">*</span></label>
                                                <textarea name="business_description" cols="30" rows="3"
                                                    class="form-control @error('business_description') is-invalid @enderror @if (old('business_description') && !$errors->has('business_description')) is-valid @endif"
                                                    id="business_description" placeholder="Masukkan deskripsi usaha anda" required>{{ old('business_description') }}</textarea>
                                                @error('business_description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="business_type_id" class="form-label">Kategori Usaha <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    class="form-select @error('business_type_id') is-invalid @enderror @if (old('business_type_id') && !$errors->has('business_type_id')) is-valid @endif"
                                                    name="business_type_id" id="business_type_id">
                                                    <option hidden disabled selected value>Pilih Kategori Usaha anda
                                                    </option>
                                                    @foreach ($business_types as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('business_type_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="sub_district_id" class="form-label">Kalurahan <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    class="form-select @error('sub_district_id') is-invalid @enderror @if (old('sub_district_id') && !$errors->has('sub_district_id')) is-valid @endif"
                                                    name="sub_district_id" id="sub_district_id">
                                                    <option hidden disabled selected value>Pilih kalurahan anda</option>
                                                    @foreach ($sub_districts as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('sub_district_id') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="address" class="form-label">Alamat Usaha <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="address"
                                                    class="form-control @error('address') is-invalid @enderror @if (old('address') && !$errors->has('address')) is-valid @endif"
                                                    id="address" placeholder="Masukkan alamat usaha anda"
                                                    value="{{ old('address') }}" required>
                                                @error('address')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="zip_code" class="form-label">Kode Pos <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" inputmode="numeric" name="zip_code"
                                                    class="form-control @error('zip_code') is-invalid @enderror @if (old('zip_code') && !$errors->has('zip_code')) is-valid @endif"
                                                    id="zip_code" placeholder="Masukkan kode pos usaha anda"
                                                    value="{{ old('zip_code') }}"
                                                    onkeypress="return isNumberKey(event)" required>
                                                @error('zip_code')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="business_phone" class="form-label">Nomor HP Usaha <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" inputmode="numeric" name="business_phone"
                                                    class="form-control @error('business_phone') is-invalid @enderror @if (old('business_phone') && !$errors->has('business_phone')) is-valid @endif"
                                                    id="business_phone" placeholder="Masukkan nomor HP usaha anda"
                                                    value="{{ old('business_phone') }}"
                                                    onkeypress="return isNumberKey(event)" required>
                                                @error('business_phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="no_pirt" class="form-label">Nomor Sertifikat PIRT</label>
                                                <input type="text" name="no_pirt"
                                                    class="form-control @error('no_pirt') is-invalid @enderror @if (old('no_pirt') && !$errors->has('no_pirt')) is-valid @endif"
                                                    id="no_pirt"
                                                    placeholder="Masukkan nomor sertifikat PIRT usaha anda"
                                                    value="{{ old('no_pirt') }}">
                                                @error('no_pirt')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <label for="website" class="form-label">Website</label>
                                                <input type="url" name="website"
                                                    class="form-control @error('website') is-invalid @enderror @if (old('website') && !$errors->has('website')) is-valid @endif"
                                                    id="website" placeholder="Contoh: https://www.example.com"
                                                    value="{{ old('website') }}">
                                                @error('website')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- SweetAlert2 --}}
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>
</body>

</html>
