<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ env('APP_NAME') }} @yield('title') </title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    @include('landing-page.layouts.css')
</head>

<body class="@yield('body-class')"><!-- Menggunakan yield untuk class body -->

    @include('landing-page.layouts.header')

    <main class="main">
        @yield('content') <!-- Tempat untuk konten halaman -->
    </main>

    @include('landing-page.layouts.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('QuickStart/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('QuickStart/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('QuickStart/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('QuickStart/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('QuickStart/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>


    <!-- Main JS File -->
    <script src="{{ asset('QuickStart/assets/js/main.js') }}"></script>

    {{-- SweetAlert2 --}}
    @include('sweetalert::alert')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const dataTable = new simpleDatatables.DataTable("#myTable", {
            searchable: true,
            fixedHeight: true,
            perPage: 10,
            labels: {
                placeholder: "Cari...",
                searchTitle: "Cari di dalam tabel",
                perPage: "data per halaman",
                pageTittle: "Halaman {page}",
                noRows: "Tidak ada data yang tersedia.",
                info: "Menampilkan {start} hingga {end} dari {rows} data",
                noResults: "Tidak ada data yang ditemukan."
            }
        });
    </script>

    @yield('script') <!-- Tempat untuk script tambahan di halaman tertentu -->
</body>

</html>
