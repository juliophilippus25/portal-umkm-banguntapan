@extends('landing-page.layouts.app')

@section('title', '| Produk')

@section('body-class', 'starter-page-page')

@section('content')
    {{-- <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Daftar Pelaku Usaha</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">Pelaku Usaha</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title --> --}}

    <!-- Starter Section Section -->
    <section id="starter-section" class="starter-section section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Daftar Produk</h2>
            <p>Cari dan temukan produk yang tersedia</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up">
            <form method="GET" action="{{ route('products') }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="product_type" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis Produk</option>
                            @foreach ($productTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ request('product_type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari produk..." />
                    </div>
                </div>
            </form>
            <!-- Card Grid -->
            <div class="row">

                @forelse ($products as $product)
                    <div class="col-lg-4">
                        <div class="card text-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}" class="card-img-top img-cover" width="300px"
                                    height="300px" />
                            @else
                                <img src="{{ asset('images/default-image.jpg') }}" alt="Profile"
                                    class="card-img-top img-cover" width="300px" height="300px" />
                            @endif

                            @php
                                $colors = [
                                    1 => 'bg-primary',
                                    2 => 'bg-success',
                                    3 => 'bg-warning',
                                    4 => 'bg-info',
                                    5 => 'bg-secondary',
                                ];
                            @endphp
                            <div class="card-body">
                                <span class="badge {{ $colors[$product->productType->id] ?? 'bg-warning' }} col-12 mb-2">
                                    {{ $product->productType->name }}
                                </span>
                                <h3 class="card-title">{{ $product->name }}</h3>
                                <h5 class="card-title">{{ $product->business->business_name }}</h5>
                                <p class="card-text">
                                    {{ $product->description ? $product->description : 'Tidak ada deskripsi iklan.' }}
                                </p>
                                <p class="text-muted">{{ formatIDR($product->price) }}</p>
                                <a href="{{ route('products.detail', $product->id) }}" class="btn btn-custom col-12">Lihat
                                    Selengkapnya</a>
                            </div>
                        </div><!-- End Card with an image on top -->
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>Tidak ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
            <!-- End Card Grid -->

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links('vendor.pagination.bootstrap-5') }} <!-- Menggunakan pagination kustom -->
            </div>
        </div>

    </section><!-- /Starter Section Section -->

@endsection
