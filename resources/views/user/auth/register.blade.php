<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ env('APP_NAME') }} | Register </title>
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
                    <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                {{-- <img src="assets/img/logo.png" alt=""> --}}
                                <span>{{ env('APP_NAME') }}</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card col-lg-12 col-md-12">
                            <div class="card-body pt-3">
                                <div class="container">
                                    <form action="{{ route('user.register') }}" method="POST">
                                        @csrf
                                        {{-- Data Penangungg Jawab --}}
                                        <div class="form-group mt-2">
                                            <h3 class="text-dark font-weight-bolder">Data Penanggung Jawab</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="name"
                                                        id="name" placeholder="Masukkan nama anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="phone" class="form-label">Nomor HP</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        id="phone" placeholder="Masukkan nomor anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="nik" class="form-label">NIK</label>
                                                    <input type="text" class="form-control" name="nik"
                                                        id="nik" placeholder="Masukkan NIK anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email"
                                                        id="email" placeholder="Masukkan email anda">
                                                </div>

                                            </div>

                                        </div>

                                        {{-- Data UMKM --}}
                                        <div class="form-group mt-5">
                                            <h3 class="text-dark font-weight-bolder">Data UMKM</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="business_name" class="form-label">Nama Usaha</label>
                                                    <input type="text" class="form-control" name="business_name"
                                                        id="business_name" placeholder="Masukkan nama usaha anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="business_description" class="form-label">Deskripsi
                                                        Usaha</label>
                                                    <input type="text" class="form-control"
                                                        name="business_description" id="business_description"
                                                        placeholder="Masukkan deskripsi usaha anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="business_type_id" class="form-label">Jenis Usaha</label>
                                                    <select class="form-select" name="business_type_id"
                                                        id="business_type_id">
                                                        <option hidden disabled selected value>Pilih jenis usaha anda
                                                        </option>
                                                        @foreach ($business_types as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="sub_district_id" class="form-label">Kelurahan</label>
                                                    <select class="form-select" name="sub_district_id"
                                                        id="sub_district_id">
                                                        <option hidden disabled selected value>Pilih kelurahan anda
                                                        </option>
                                                        @foreach ($sub_districts as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="address" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" name="address"
                                                        id="address" placeholder="Masukkan alamat usaha anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="zip_code" class="form-label">Kode Pos</label>
                                                    <input type="text" class="form-control" name="zip_code"
                                                        id="zip_code" placeholder="Masukkan kode pos usaha anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="business_phone" class="form-label">Nomor Telp</label>
                                                    <input type="text" class="form-control" name="business_phone"
                                                        id="business_phone"
                                                        placeholder="Masukkan nomor telepon usaha anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="no_pirt" class="form-label">Nomor Sertifikat
                                                        PIRT</label>
                                                    <input type="text" class="form-control" name="no_pirt"
                                                        id="no_pirt"
                                                        placeholder="Masukkan kode nomor PIRT usaha anda">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                                    <label for="website" class="form-label">Website</label>
                                                    <input type="text" class="form-control" name="website"
                                                        id="website"
                                                        placeholder="Masukkan URL/Link website usaha anda">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-primary">Daftar</button>
                                        </div>
                                    </form>
                                </div>
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

    <!-- Vendor JS Files -->
    <script src="{{ asset('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
