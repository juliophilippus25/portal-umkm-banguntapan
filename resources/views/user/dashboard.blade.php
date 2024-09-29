@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    @if (auth('user')->user()->is_default_password)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Anda masih menggunakan kata sandi bawaan. Silakan ganti klik <a
                                href="{{ route('user.profile') }}">disini</a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Produk Card -->
                    <div class="col-xxl-4 col-md-6 col-lg-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Produk</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bag"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $countProduct }}</h6>
                                        <a href="{{ route('user.products') }}">
                                            <span class="text-primary small pt-1 fw-bold">Lihat detail <i
                                                    class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Produk Card -->

                    <!-- Iklan Card -->
                    <div class="col-xxl-4 col-md-6 col-lg-6">
                        <div class="card info-card customers-card">

                            <div class="card-body">
                                <h5 class="card-title">Iklan</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-badge-ad"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $countAd }}</h6>
                                        <a href="{{ route('user.advertisements') }}">
                                            <span class="text-primary small pt-1 fw-bold">Lihat detail <i
                                                    class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Iklan Card -->

                </div>
            </div><!-- End Left side columns -->
        </section>

    </main><!-- End #main -->

@endsection
